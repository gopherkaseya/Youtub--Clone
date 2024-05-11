<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New video</title>
    <link rel="stylesheet" href="{{asset('css/new-video-style.css')}}">
</head>
<body>
    <form id="videoForm" method="post" action="/video" enctype="multipart/form-data">
        @csrf
        @error('title')
        {{$message}}
        @enderror
        <label for="title">Titre de la Vidéo</label>
        <input type="text" id="title" name="title" required>
        <label for="description">Description de la video</label>
        <input type="text" id="description" name="description" required>
        @error('video')
        {{$message}}
        @enderror
        <label for="video">Sélectionnez une Vidéo </label>
        <input type="file" id="video" name="video" accept="video/*" >
        @error('image')
        {{$message}}
        @enderror
        <label for="photo">
                Sélectionnez une Photo <img src="{{asset('images/image (2).png')}}" alt="Icône">
        </label>
        <input type="file" id="photo" name="image" accept="image/*" onchange="previewImage()" required>

        <div class="file-upload-container">
            <p>Prévisualisation de la Photo </p>
            <img id="imagePreview" alt="Aperçu de la Photo" style="display: none;">
        </div>

        <button type="submit">Ajouter la Vidéo</button>
    </form>
    <script>
        function previewImage() {
            const fileInput = document.getElementById('photo');
            const imagePreview = document.getElementById('imagePreview');

            const file = fileInput.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>
</html>
