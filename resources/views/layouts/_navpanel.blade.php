<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li ><a href="/app">Overview <span class="sr-only">(current)</span></a></li>
                <li @if($page['id'] == 'send_message') class="active" @endif><a href="/app/send/send">Send Message</a></li>
                <li @if($page['id'] == 'citizen_upload') class="active" @endif><a href="/app/citizen/upload">Citizen Uploader</a></li>
                <li @if($page['id'] == 'dataset_manager') class="active" @endif><a href="/app/datalogger/">Data Set Manager</a></li>
            </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            @yield('main')
        </div>
    </div>
</div>