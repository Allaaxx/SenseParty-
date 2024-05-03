<div>
        <div class="pd-20 card-box height-100-p">
            <div class="profile-photo">
                <a href="javascript:;" onclick="event.preventDefault();document.getElementById('adminProfilePictureFile').click()" class="edit-avatar"><i class="fa fa-pencil"></i></a>
                <img src="{{ $admin->picture }}" alt="" class="avatar-photo" id="adminProfilePicture">
                <input type="file" name="adminProfilePictureFile" id="adminProfilePictureFile" class="d-none" style="opacity: 0;">
            </div>
            <h5 class="text-center h5 mb-0" id="adminProfileName">{{$admin->name}}</h5>

            <p class="text-center text-muted font-14" id="adminProfileEmail">
                {{$admin->email}}
            </p>
        </div>
  
</div>
