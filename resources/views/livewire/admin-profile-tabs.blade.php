<div>
    <div class="profile-tab height-100-p">
        <div class="tab height-100-p">
            <!-- Abas de navegação -->
            <ul class="nav nav-tabs customtab" role="tablist">
                <li class="nav-item">
                    <a wire:click.prevent='selectTab("personal_details")' class="nav-link {{$tab == 'personal_details' ? 'active' : ''}}" data-toggle="tab" href="#personal_details" role="tab">Detalhes pessoais</a>
                </li>
                <li class="nav-item">
                    <a wire:click.prevent='selectTab("update_password")' class="nav-link {{$tab == 'update_password' ? 'active' : ''}}" data-toggle="tab" href="#update_password" role="tab">Redefinir Senha</a>
                </li>
            </ul>
            <!-- Conteúdo das abas -->
            <div class="tab-content">
                <!-- Detalhes pessoais -->
                <div class="tab-pane fade {{$tab == 'personal_details' ? 'active show' : ''}}" id="personal_details" role="tabpanel">
                    <div class="pd-20">
                        <form wire:submit.prevent="updateAdminPersonalDetails()">
                            <!-- Campos de entrada -->
                            <div class="row">
                                <!-- Nome -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Nome:</label>
                                        <input type="text" class="form-control" wire:model='name' placeholder="Digite o nome completo">
                                        @error('name') 
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Email -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Email:</label>
                                        <input type="text" class="form-control" wire:model='email' placeholder="exemplo@email.com">
                                        @error('email') 
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Usuário -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Usuário:</label>
                                        <input type="text" class="form-control" wire:model='username' placeholder="Digite o usuário">
                                        @error('username') 
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- Botão de salvar alterações -->
                            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                        </form>
                    </div>
                </div>
                <!-- Redefinir senha -->
                <div class="tab-pane fade {{$tab == 'update_password' ? 'active show' : ''}}" id="update_password" role="tabpanel">
                    <div class="pd-20 profile-task-wrap">
                        ------ Redefinir Senha aqui ------
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
