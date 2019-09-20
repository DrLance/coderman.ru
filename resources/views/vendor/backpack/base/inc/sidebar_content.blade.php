<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class='nav-item'>
  <a class='nav-link' href="{{ backpack_url('dashboard') }}"><i
      class="nav-icon fa fa-dashboard"></i> {{ trans('backpack::base.dashboard') }}</a>
</li>

<!-- News: Articles, Categories, Tags  -->
<li class='nav-item nav-dropdown'>
  <a class='nav-link nav-dropdown-toggle' href="#"><i class="nav-icon fa fa-sitemap"></i>Content</a>
  <ul class="nav-dropdown-items">
    <li class='nav-item'>
      <a class='nav-link' href="{{ backpack_url('type') }}"><i class="nav-icon fa fa-exchange"></i> Types</a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href="{{ url(config('backpack.base.route_prefix').'/page') }}"><i class="nav-icon fa fa-files-o"></i>
        Pages</a>
    </li>
  </ul>
</li>

<li class='nav-item nav-dropdown'>
  <a class='nav-link nav-dropdown-toggle' href="#"><i class="nav-icon fa fa-users"></i>Users</a>
  <ul class="nav-dropdown-items">
    <li class='nav-item'>
      <a class='nav-link' href="{{ backpack_url('user') }}"><i
          class="nav-icon fa fa-user"></i>Users</a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href="{{ backpack_url('role') }}"><i
          class="nav-icon fa fa-user"></i>Roles</a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href="{{ backpack_url('permission') }}"><i
          class="nav-icon fa fa-user"></i>Permissions</a>
    </li>
  </ul>
</li>

@role('admin')

<li class='nav-item'><a class='nav-link' href="{{ backpack_url('elfinder') }}"><i class="nav-icon fa fa-files-o"></i>
    <span>{{ trans('backpack::crud.file_manager') }}</span></a></li>

@endrole
