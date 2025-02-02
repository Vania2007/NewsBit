<?php
include_once "dbconnect.php";
ob_start();
session_start();
if (!$_SESSION['user_login']) {
    header("Location: index.php");
} else {

    include "header.php";
    if (isset($_SESSION['add']) && $_SESSION['add'] == true) {
        echo <<<EOD
      <div class="col-lg-6 container alert alert-success mt-5" role="alert">
          Стаття була успішно додана!
      </div>
      EOD;
        $_SESSION['add'] = false;
    }
    ?>

<div class="container my-5">
  <h3>Додати статтю</h3>
  <form name="myForm" action="action.php" method="post" id="myForm" onSubmit="return overify_message(this);" enctype="multipart/form-data">
  <input type=hidden name="action" value="add">
    <div class="form-group">
      <label for="title">Назва статті:</label>
      <input type="text" class="form-control" id="title" name="title">
    </div>
    <div class="form-group">
      <label for="category">Категорія:</label>
      <select class="form-control" id="category" name="category">
        <option value="Політика">Політика</option>
        <option value="Бізнес">Бізнес</option>
        <option value="Суспільство">Суспільство</option>
        <option value="Технології">Технології</option>
        <option value="Спорт">Спорт</option>
        <option value="Кримінал">Кримінал</option>
        <option value="Культура">Культура</option>
        <option value="Шоу-бізнес">Шоу-бізнес</option>
        <option value="Автомобільне">Автомобільне</option>
        <option value="Екологія">Екологія</option>
      </select>
    </div>
    <div class="form-group">
    <label for="article-content">Вміст статті:</label>
    <textarea class="form-control" id="article-content" name="message"></textarea>
    <script>
    ClassicEditor
        .create(document.querySelector('#article-content'))
        .then(editor => {
            window.editorInstance = editor;
        })
        .catch(error => {
            console.error(error);
        });

    document.getElementById('myForm').addEventListener('submit', function(event) {
        const editorData = window.editorInstance.getData();
        if (!editorData) {
            alert('Вміст статті не може бути порожнім!');
            event.preventDefault();
        } else {
            document.querySelector('#article-content').value = editorData;
        }
    });
</script>
</div>
    <div class="form-group">
      <label for="image">Оберіть зображення:</label>
      <input type="hidden" name="image_name" id="image_name">
      <input type="file" class="form-control" id="article-image" name="article-image">
    </div>
    <input type="submit" class="btn btn-primary" id="submit-btn" name="submitAdd" value="Опублікувати статтю">
  </form>
</div>
<div class="container my-5">

</div>

<?php
}
include "footer.php";