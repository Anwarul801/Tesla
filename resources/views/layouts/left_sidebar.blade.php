 <div class="vertical-menu">
     {{--
 @Author: Anwarul
 @Date: 2025-11-17 17:12:23
 @LastEditors: Anwarul
 @LastEditTime: 2026-01-07 12:36:12
 @Description: Innova IT
 --}}
     <div data-simplebar class="h-100">
         @auth()
             <!--- Sidemenu -->
             <div id="sidebar-menu">
                 <!-- Left Menu Start -->
                 <ul class="metismenu list-unstyled" id="side-menu">
                     <li>
                         <a href="{{ route('dashboard') }}" class="waves-effect">
                             <i class="ri-dashboard-line"></i>
                             <span>Dashboard</span>
                         </a>
                     </li>
                     @canany(['users.index', 'roles.index', 'permissions.index'])
                         <li>
                             <a href="javascript: void(0);" class="waves-effect">
                                 <i class="ri-account-circle-line"></i>
                                 <span>Users</span>
                                 <i class="float-right has-arrow"></i>
                             </a>
                             <ul class="sub-menu ml-3" aria-expanded="false">
                                 @can(['users.index'])
                                     <li><a class="nav-link" href="{{ route('users.index') }}"><i class=" ri-user-add-line"></i>
                                             Manage Users</a></li>
                                 @endcan
                                 @can(['permissions.index'])
                                     <li><a class="nav-link" href="{{ route('permissions.index') }}"> <i
                                                 class=" ri-lock-2-line"></i>
                                             Manage permission</a></li>
                                 @endcan
                                 @can(['roles.index'])
                                     <li><a class="nav-link" href="{{ route('roles.index') }}"><i class="ri-share-line"></i> Manage
                                             Role</a></li>
                                 @endcan
                             </ul>
                         </li>
                     @endcanany
                     @can('course.index')
                         <li>
                             <a href="{{ route('course.index') }}">
                                 <i class="fas fa-list"></i> Course List</a>
                         </li>
                     @endcan
                     @can('division.index')
                         <li>
                             <a href="{{ route('division.index') }}">
                                 <i class="fas fa-list"></i> Division</a>
                         </li>
                     @endcan
                     @can('district.index')
                         <li>
                             <a href="{{ route('district.index') }}">
                                 <i class="fas fa-list"></i> District</a>
                         </li>
                     @endcan
                     @can('thana.index')
                         <li>
                             <a href="{{ route('thana.index') }}">
                                 <i class="fas fa-list"></i> Thana</a>
                         </li>
                     @endcan

                     @can(['setting.index'])
                         <li>
                             <a href="{{ route('setting.index') }}" class=" waves-effect">
                                 <i class="ri-settings-2-line"></i>
                                 <span>Settings</span>
                             </a>
                         </li>
                     @endcan

                     @can(['book.index'])
                         <li>
                             <a href="{{ route('book.index') }}" class=" waves-effect">
                                 <i class=" ri-book-line"></i>
                                 <span>Books</span>
                             </a>
                         </li>
                     @endcan
                     @can(['book_qr_code.index'])
                         <li>
                             <a href="{{ route('book_qr_code.index') }}" class=" waves-effect">
                                 <i class=" ri-qr-code-fill"></i>
                                 <span>Book Qr Code</span>
                             </a>
                         </li>
                     @endcan

                 </ul>
             </div>
             <!-- Sidebar -->
         @endauth
     </div>
 </div>
