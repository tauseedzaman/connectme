 <!-- main content -->
 <div class="main-content right-chat-active">
     <?php
     $icons = new \Feather\IconManager();
     ?>
     <div class="middle-sidebar-bottom">
         <div class="middle-sidebar-left pe-0">
             <div class="row">
                {{ $search ?? "" }}
                 <div class="col-xl-12">
                     <div class="card shadow-xss w-100 d-block d-flex border-0 p-4 mb-3">
                         <div class="card-body d-flex align-items-center p-0">
                             <h2 class="fw-700 mb-0 mt-0 font-md text-grey-900">Friends {{ $search }}</h2>
                             <div class="search-form-2 ms-auto">
                                 <i class=" font-xss" style="margin-top: -10px">{!! $icons->getIcon('search') !!}</i>
                                 <input type="text" wire:model="search"
                                     class="form-control text-grey-500 mb-0 bg-greylight theme-dark-bg border-0"
                                     placeholder="Search here.">
                             </div>
                             {{-- <a href="#" class="btn-round-md ms-2 bg-greylight theme-dark-bg rounded-3"><i class=" font-xss text-grey-500"></i></a> --}}
                         </div>
                     </div>

                     {{-- <div class="row ps-2 pe-2">
                         @forelse ($users as $user)
                             <div class="col-md-3 col-sm-4 pe-2 ps-2">
                                 <div class="card d-block border-0 shadow-xss rounded-3 overflow-hidden mb-3">
                                     <div class="card-body d-block w-100 ps-3 pe-3 pb-4 text-center">
                                         <figure class="avatar ms-auto me-auto mb-0 position-relative w65 z-index-1">
                                             <img src="{{ asset('storage') . '/' . $user->profile }}" alt="image"
                                                 class="float-right p-0 bg-white rounded-circle w-100 shadow-xss">
                                         </figure>
                                         <div class="clearfix"></div>
                                         <h4 class="fw-700 font-xsss mt-3 mb-1">
                                             {{ $user->first_name . ' ' . $user->last_name }} </h4>
                                         <p class="fw-500 font-xsssss text-grey-500 mt-0 mb-3">
                                             {{ '@' . $user->username }}
                                         </p>
                                         <a href="#"
                                             class="mt-0 btn pt-2 pb-2 ps-3 pe-3 lh-24 ms-1 ls-3 d-inline-block rounded-xl bg-success font-xsssss fw-700 ls-lg text-white">ADD
                                             FRIEND</a>
                                     </div>
                                 </div>
                             </div>
                         @empty
                             <h1 class="text-center text-danger">No User Fund!</h1>
                         @endforelse


                     </div> --}}
                 </div>
             </div>
         </div>

     </div>
 </div>
 <!-- main content -->
