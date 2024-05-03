<div>
    
    <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
            <div class="pd-20 card-box height-100-p">
                <div class="profile-photo">
                    <a href="javascript:;" onclick="event.preventDefault(); document.getElementById('sellerProfilePictureFile').click();" class="edit-avatar"><i
                            class="fa fa-pencil"></i></a>
                    <img src="{{ $seller->picture}}" alt="" class="avatar-photo"  id="sellerProfilePicture">
                    <input type="file" name="sellerProfilePictureFile" id="sellerProfilePictureFile" class="d-none" style="opacity: 0">
                </div>
                <h5 class="text-center h5 mb-0">{{ $seller->name}}</h5>
                <p class="text-center text-muted font-14">
                    {{ $seller->email }}
                </p>
            </div>
        </div>
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
            <div class="card-box height-100-p overflow-hidden">
                <div class="profile-tab height-100-p">
                    <div class="tab height-100-p">
                        <ul class="nav nav-tabs customtab" role="tablist">
                            <li class="nav-item">
                                <a wire:click.prevent='selectTab("personal_details")' class="nav-link {{$tab == 'personal_details' ? 'active' : ''}}" data-toggle="tab" href="#personal_details"
                                    role="tab">Detalhes pessoais</a>
                            </li>
                            <li class="nav-item">
                                <a wire:click.prevent='selectTab("update_password")' class="nav-link {{$tab == 'update_password' ? 'active' : ''}}" data-toggle="tab" href="#update_password" role="tab">Redefinir
                                    Senha</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <!-- Timeline Tab start -->
                            <div class="tab-pane fade {{ $tab == 'personal_details' ? 'active show' : '' }}" id="personal_details" role="tabpanel">
                                <div class="pd-20">
                                    <form wire:submit='updateSellerPersonalDetails()'>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Nome</label>
                                                    <input type="text" class="form-control" wire:model.live='name' placeholder="Digite o Nome completo">
                                                    @error('name') 
                                                        <span class="text-danger">{{ $message }}</span> 
                                                    @enderror
                                                </div>
                                            </div>
            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Email</label>
                                                    <input type="text" class="form-control" wire:model.live='email' placeholder="Digite o Email" disabled>
                                                    @error('name') 
                                                        <span class="text-danger">{{ $message }}</span> 
                                                    @enderror
                                                </div>
                                            </div>
            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Usuario</label>
                                                    <input type="text" class="form-control" wire:model.live='username' placeholder="Digite o Usuário">
                                                    @error('username') 
                                                        <span class="text-danger">{{ $message }}</span> 
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Phone</label>
                                                    <input type="text" class="form-control" wire:model.live='phone' placeholder="Digite o  Número de telefone">
                                                    @error('phone') 
                                                        <span class="text-danger">{{ $message }}</span> 
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Endereço</label>
                                                    <input type="text" class="form-control" wire:model.live='address' placeholder="Digite o Endereço">
                                                    @error('address') 
                                                        <span class="text-danger">{{ $message }}</span> 
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
            
                                        <button type="submit" id="btnNotification" class="btn btn-primary">Salvar Alterações</button>
                                    </form>
                                </div>
                            </div>
                            <!-- Timeline Tab End -->
                            <!-- Tasks Tab start -->
                            <div class="tab-pane fade {{ $tab == 'update_password' ? 'active show' : '' }}" id="update_password" role="tabpanel">
                                <div class="pd-20 profile-task-wrap">
                                    <form wire:submit='updatePassword()'>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Senha Atual</label>
                                                    <input type="password" placeholder="Digite sua senha atual" wire:model='current_password' class="form-control" class="form-control">
                                                    @error('current_password') 
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
            
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Nova Senha</label>
                                                    <input type="password" placeholder="Digite sua nova senha" wire:model='new_password' class="form-control">
                                                    @error('new_password') 
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
            
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Confirmar Nova Senha</label>
                                                    <input type="password" placeholder="Confirme sua nova senha" wire:model='new_password_confirmation' class="form-control">
                                                    @error('new_password_confirmation') 
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Mudar senha</button>
                                    </form>
                                </div>
                            </div>
                            <!-- Tasks Tab End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
