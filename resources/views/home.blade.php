<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <!-- icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />
    <!-- font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <title>Song</title>
</head>

<body>
    <button type="button" class="btn btn-primary m-3" onclick="openModalCRUD(0)">
        <i class="fa fa-plus"></i>
        Thêm mới
    </button>
    <div class="player">
        @include('include.dashboard')
        <div class="playlist"></div>
    </div>
    @include('add_edit')
    <script>
        const $ = document.querySelector.bind(document);
        const playlist = $`.playlist`;
        const cd = $`.cd`;
        const playbtn = $`.btn-toggle-play`;
        const header = $`header h2`;
        const cdThumb = $`.cd .cd-thumb`;
        const audio = $`#audio`;
        const player = $`.player`;
        const nextbtn = $`.btn-next`;
        const prebtn = $`.btn-prev`;
        const progress = $`.progress`;
        const ramdombtn = $`.btn-random`;
        const repeatbtn = $`.btn-repeat`;
        const modal_header = $`#modal-header`;
        const crud_modal = $`#crud-modal-size-small`;
        const form_add_edit = $`#form_add_edit`;

        const id = $`#id`;
        const name = $`#name`;
        const singer = $`#singer`;
        const image = $`#image`;
        const music = $`#music`;
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>