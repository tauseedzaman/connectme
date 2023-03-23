<div class="main-content bg-lightblue theme-dark-bg right-chat-active">
    @php
        $icons = new \Feather\IconManager();
        $icons->setSize(14);
    @endphp
    <div class="middle-sidebar-bottom">
        <div class="middle-sidebar-left">
            <div class="middle-wrap">
                <div class="card w-100 border-0 bg-white shadow-xs p-0 mb-4">
                    <div class="card-body p-4 w-100 bg-current border-0 d-flex rounded-3">
                        <a href="{{ route('settings') }}" class="d-inline-block mt-2"><i
                                class=" font-sm text-white" style="margin-top: -10px">{!!  $icons->getIcon("arrow-left") !!}</i></a>
                        <h4 class="font-xs text-white fw-600 ms-4 mb-0 mt-2">Social Network</h4>
                    </div>
                    <div class="card-body p-lg-5 p-4 w-100 border-0">
                        <form wire:submit.prevent="save">


                            <div class="row">

                                <div class="col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label class="mont-font fw-600 font-xsss">Facebook</label>
                                        <input type="url" name="Facebook" wire:model.lazy="Facebook"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label class="mont-font fw-600 font-xsss">Twitter</label>
                                        <input type="url" name="Twitter" wire:model.lazy="Twitter"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label class="mont-font fw-600 font-xsss">Linkedin</label>
                                        <input type="url" name="Linkedin" wire:model.lazy="Linkedin"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label class="mont-font fw-600 font-xsss">Instagram</label>
                                        <input type="url" name="Instagram" wire:model.lazy="Instagram"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label class="mont-font fw-600 font-xsss">Flickr</label>
                                        <input type="url" name="Flickr" wire:model.lazy="Flickr"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label class="mont-font fw-600 font-xsss">Github</label>
                                        <input type="url" name="Github" wire:model.lazy="Github"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label class="mont-font fw-600 font-xsss">Skype</label>
                                        <input type="url" name="Skype" wire:model.lazy="Skype"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label class="mont-font fw-600 font-xsss">Google</label>
                                        <input type="url" name="Google" wire:model.lazy="Google"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="col-lg-12 mb-0 mt-2">
                                    <button type="submit"
                                        class="bg-current text-center text-white font-xsss fw-600 p-3 w175 rounded-3 d-inline-block">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
