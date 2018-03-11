<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Upload Image</title>

    <style type="text/css">
        body, html {
            height: 100%;
            padding: 0;
            margin: 0;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: start;
        }

        .title {
            display: flex;
            width: 100%;
        }

        .title label {
            margin-right: 8px;
        }

        form > * {
            margin-bottom: 8px;
        }

        .title input {
            flex-grow: 1;
        }

        .container {
            max-width: 640px;
            padding: 16px;
        }

        .hidden {
            display: none;
        }
    </style>
</head>
<body>
<script type="application/javascript">
    function submit() {
        const title = window.title.value.trim();
        if (!title) {
            return showError('missing input title');
        }
        if (window.file.files.length === 0) {
            return showError('missing input file');
        }
        const file = window.file.files[0];
        postImageData('/images/', {title})
            .then(image => uploadImage(`/images/${image.id}/upload`, file))
            .then(image => showImage(image.url))
            .catch(function (e) {
                console.error('could not upload image', e);
                showError('could not upload image');
            })
    }

    function showError(msg) {
        alert(`ERROR: ${msg}`);
    }

    function showImage(url) {
        window.image.classList.remove('hidden');
        window.image.src = url;
    }

    function postImageData(path, data) {
        const backendUrl = '<?= $_ENV['BACKEND_URL'] ?>';
        return fetch(`${backendUrl}${path}`, {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
        }).then(response => response.json());

    }

    function uploadImage(path, image) {
        const backendUrl = '<?= $_ENV['BACKEND_URL'] ?>';
        const data = new FormData();
        data.append('image', image);
        return fetch(`${backendUrl}${path}`, {
            method: 'PUT',
            headers: {
                'Accept': 'application/json',
            },
            body: data,
        }).then(response => response.json());

    }
</script>
<form action="javascript:submit()" class="container">
    <h1>Upload Image</h1>
    <div class="title">
        <label for="title">Title: </label>
        <input type="text" id="title" name="title">
    </div>
    <input type="file" id="file" name="file">
    <input type="submit" value="upload">
    <img src="" alt="uploaded image" id="image" class="hidden">
</form>
</body>
</html>
