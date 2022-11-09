<?php

?>

<!DOCTYPE html>
<html>
<head>
    <script src="https://cdn.tiny.cloud/1/j9xmhw8bx062069njjeewsmov289hxxtzlcg26mdvr10jkdi/tinymce/6/tinymce.min.js"
            referrerpolicy="origin"></script>
</head>
<body>
  <textarea>
    Welcome to TinyMCE!
  </textarea>
  <script>
      tinymce.init({
          selector: 'textarea',
          plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect',
          toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
          tinycomments_mode: 'embedded',
          tinycomments_author: 'Author name',
          mergetags_list: [
              {value: 'First.Name', title: 'First Name'},
              {value: 'Email', title: 'Email'},
          ],
      });
  </script>
</body>
</html>
