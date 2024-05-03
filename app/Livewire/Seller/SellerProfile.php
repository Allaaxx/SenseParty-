<?php
namespace App\Livewire\Seller;

use Livewire\Component;
use App\Models\Seller;
use Illuminate\Support\Facades\Hash;

class SellerProfile extends Component
{
    public $tab = null;
    public $tabname = 'personal_details';
    public $name, $email, $username, $phone, $address;
    public $current_password, $new_password, $new_password_confirmation; 
        
    protected $queryString = ['tab' => ['keep' => true]];

    protected $listeners = [
        'updateSellerProfilePage' => '$refresh'
        
    ];

    public function selectTab($tab){
        $this->tab = $tab;
    }

    public function mount(){
        $this->tab = request()->tab ? request()->tab : $this->tabname;

        //POPULATE
        $seller = Seller::findOrfail(auth('seller')->id());
        $this->name = $seller->name;
        $this->email = $seller->email;
        $this->username = $seller->username;
        $this->phone = $seller->phone;
        $this->address = $seller->address;
    }
    
    public function updateSellerPersonalDetails(){
        //validate the form
        $this->validate([
            'name' => 'required|min:5',
            'username' => 'nullable|min:5|unique:sellers,username,'.auth('seller')->id(),
        ]);
        $seller = Seller::findOrfail(auth('seller')->id());
        $seller->name = $this->name;
        $seller->username = $this->username;
        $seller->address = $this->address;
        $seller->phone = $this->phone;
        $update = $seller->save();

        if($update){
            $this->dispatch('updateAdminSellerHeaderInfo');
            $this->showToastr('success', 'Detalhes pessoais atualizados com sucesso!');
        }else{
            $this->showToastr('error', 'Algo deu errado, tente novamente!');
        }
    }

    public function updatePassword(){
        $seller = Seller::findOrfail(auth('seller')->id());

        //Validate the form
        $this->validate([
            'current_password' => [
                'required',
                function($attribute, $value, $fail) use ($seller){
                    if(!Hash::check($value, $seller->password)){
                        return $fail(__('Senha atual incorreta!'));
                    }
                }
            ],
            'new_password' => 'required|min:5|max:45|confirmed',
        ]);

        //update seller password

        $update = $seller->update([
            'password' => Hash::make($this->new_password)
        ]);

        if( $update ){
            //send email to seller
            $data['seller'] = $seller;
            $data['new_password'] = $this->new_password;

            $mail_body = view('email-templates.seller-reset-email-template', $data);

            $mailConfig = [
                'mail_from_email' => env('MAIL_FROM_ADDRESS'),
                'mail_from_name' => env('MAIL_FROM_NAME'),
                'mail_recipient_email' => $seller->email,
                'mail_recipient_name' => $seller->name,
                'mail_subject' => 'Sua senha foi alterada com sucesso!',
                'mail_body' => $mail_body
            ];

            sendEmail($mailConfig);
            $this->current_password = null;  
            $this->new_password = null;
            $this->new_password_confirmation = null;
            $this->showToastr('success', 'Senha atualizada com sucesso!');
            
        }else{
            $this->showToastr('error', 'Algo deu errado, tente novamente!');
        }
    }

    public function showToastr($type, $message){
        return $this->dispatch('showToastr', [
            'type' => $type,
            'message' => $message
        ]);
    }

    public function render()
    {
        return view('livewire.seller.seller-profile', [
            'seller' => Seller::findOrfail(auth('seller')->id())
        ]);
    }
}
