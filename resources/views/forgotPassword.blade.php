@include ('css')
<div class="page page-center">
      <div class="container container-tight py-4">
        <form class="card card-md" action="{!! url('forgot') !!}" method="post" autocomplete="off" novalidate>
        @csrf
          <div class="card-body">
          <div class="text-center">        
                    <img src="admin/img/join-logo.png" width="200" height="50" alt="logo" class="navbar-brand-image">
                </div>
                <br>
            <h2 class="card-title text-center mb-4">Forgot password</h2>
                    @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif
            <p class="text-secondary mb-4">Enter your email address and your password will be reset and emailed to you.</p>
            <div class="mb-3">
                        <label class="form-label">IDNo/UniRollNo/ClassRollNo</label>
                        <input type="text" name="username" class="form-control" placeholder="RollNo" autocomplete="off">
                    </div>
            <div class="mb-3">
              <label class="form-label">Email address</label>
              <input type="email" class="form-control" name="email" placeholder="Enter email">
            </div>
            <div class="form-footer">
           
                        <button type="submit" class="btn btn-primary w-100">
                   
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" /><path d="M3 7l9 6l9 -6" /></svg>
                Send me new password
              </a>
              </button>
            </div>
          </div>
        </form>
        <div class="text-center text-secondary mt-3">
          Forget it, <a href="/">send me back</a> to the sign in screen.
        </div>
      </div>
    </div>
@include ('script')
