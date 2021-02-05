  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        By <a href="https://github.com/tarekwagih43" target="_blank">Tarek Wagih</a>
    </div>
    <strong>Copyright &copy; {{ date('Y') }} <a href="{{ route('/') }}">Final Project</a>.</strong> All rights reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <img src="{{ asset(auth()->user()->image) }}" class="rounded mx-auto d-block mt-3" alt="{{ auth()->user()->name }}">

    <div class="p-3 control-sidebar-content">
        <h5>Current User Data</h5>
        <hr class="mb-2">
        <h6>Name</h6>
        <div class="mb-1"><input type="text" value="{{ auth()->user()->name }}" class="mr-1"></div>
        <hr class="mb-2">
        <h6>Username</h6>
        <div class="mb-1"><input type="text" value="{{ auth()->user()->username }}" class="mr-1"></div>
        <hr class="mb-2">
        <h6>Email</h6>
        <div class="mb-1"><input type="text" value="{{ auth()->user()->email }}" class="mr-1"></div>
    </div>
</aside>
<!-- /.control-sidebar -->
