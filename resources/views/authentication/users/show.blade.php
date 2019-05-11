 <!-- Modal show  -->
  <div class="modal fade" id="users_myModal_show" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Details</h4>
        </div>
        <div class="modal-body">
         <!-- Detail of user-->
         <div class="row">
           <div class="col-md-6">
             <dl>
              <dt>Full Name</dt>
              <dd>{{$user->full_name}}</dd>
              <dt>Username</dt>
              <dd>{{$user->username}}</dd>
              <dt>Email</dt>
              <dd>{{$user->email}}</dd>
              <dt>Member On</dt>
              <dd>{{$user->created_at}}</dd>
              <dt>Status</dt>
              <dd>{{($user->status==1)?'Active':'Deactive'}}</dd>
            </dl>
           </div>
           <div class="col-md-6">
               <img src="{{asset('backend/images/avatar/'.$user->avatar)}}" style="width: 77%;border-radius: 98px; height: 196px;" class="user-image">
           </div>
         </div>
            
          
         <!-- Details of user-->
        </div>
      </div>
  </div>
</div>