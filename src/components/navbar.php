<nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center w-100">
            <div class="navbar-wrapper d-flex align-items-center">
                <div class="navbar-toggle d-inline">
                    <button type="button" class="navbar-toggler">
                        <span class="navbar-toggler-bar bar1"></span>
                        <span class="navbar-toggler-bar bar2"></span>
                        <span class="navbar-toggler-bar bar3"></span>
                    </button>
                </div>
                <a class="navbar-brand" href="javascript:void(0)"><?php echo $pageTitle; ?></a>
            </div>
            <div class="collapse navbar-collapse show" id="navigation">
                <ul class="navbar-nav ml-auto d-flex">
                    <div class="form-check form-switch d-flex align-items-center flex-row-reverse">
                        <!-- <label class="form-check-label" for="flexSwitchCheckChecked">Exibição automática</label> -->
                        <input id="autoSwitch" class="form-check-input mb-1" type="checkbox" role="switch" style="display: none;" checked="">
                    </div>
                    <li class="separator d-lg-none"></li>
                </ul>
            </div>
        </div>
    </div>
</nav>