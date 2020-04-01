<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jean Forteroche</title>
    <meta name="description" content="Blog de Jean Forteroche">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo ASSETS;?>img/book-open-solid.svg">
    <link rel="stylesheet" href="<?php echo ASSETS;?>css/style.css">
    <script src="https://cdn.tiny.cloud/1/rhmcwo4c3c04oqicyi140d661xaxcuor848zntmj4er65w6b/tinymce/5/tinymce.min.js"
    referrerpolicy="origin"></script>
    <link href="https://fonts.googleapis.com/css?family=Oxygen&display=swap" rel="stylesheet">
</head>
<body>
<header>
    <nav class="navbar">
        <div class="nav-item">
            <a href='https://jogu.fr/forteroche/home'>
                <h1>Jean Forteroche</h1>
            </a>
        </div>
        <ul class="nav-item end-row">            
            <?php if (isset($_SESSION['auth'])): ?>
            <?php if ($_SESSION['auth']->admin == 1): ?>
                <li class="link_jf">
                    <a href="<?php echo HOST;?>create">
                        Ajouter un article 
                    </a>
                </li>
            <?php endif; ?>
                <li class="link_jf">
                    <a href="<?php echo HOST;?>account">
                        Mon compte
                    </a>
                </li>
                <li class="link_jf">
                    <a href="<?php echo HOST;?>logout">
                        Se déconnecter
                    </a>
                </li>
            <?php else: ?>
                <li class="link_jf">
                    <a href="<?php echo HOST;?>register">
                        S'inscrire
                    </a>
                </li>
                <li class="link_jf">
                    <a href="<?php echo HOST;?>login">
                        Se connecter
                    </a>
                </li>
            <?php endif; ?>
        </ul>
        <div class="menu-burger-main">  
            <div class="nav-wrapper">
                <input type="checkbox" id="menu_checkbox" class="menu_checkbox">
                <label for="menu_checkbox" class="menu-toggle">
                    <img class="icon-burger" src="<?php echo ASSETS;?>img/bars-solid.svg">
                </label>
                <ul class="menu-burger">
                    <?php if (isset($_SESSION['auth'])): ?>
                    <?php if ($_SESSION['auth']->admin == 1): ?>
                        <li class="link_jf">
                            <a href="<?php echo HOST;?>create">
                                Ajouter un article 
                            </a>
                        </li>
                    <?php endif; ?>
                        <li class="link_jf">
                            <a href="<?php echo HOST;?>account">
                                Mon compte
                            </a>
                        </li>
                        <li class="link_jf">
                            <a href="<?php echo HOST;?>logout">
                                Se déconnecter
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="link_jf">
                            <a href="<?php echo HOST;?>register">
                                S'inscrire
                            </a>
                        </li>
                        <li class="link_jf">
                            <a href="<?php echo HOST;?>login">
                                Se connecter
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div> 
        </ul>
    </nav>
</header>
<div class="article_container">

<div class="notif">
<?php if(isset($_SESSION['flash'])): ?>
        <?php foreach($_SESSION['flash'] as $type => $message): ?>
            <div class="alert alert-<?= $type; ?>">
                <?= $message; ?>
            </div>
        <?php endforeach; ?>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>
</div>

<?php echo $contentPage; ?>
</div>
<footer>
</footer>
<script>
    tinymce.init({
  selector: 'textarea#mytextarea',
  plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
  imagetools_cors_hosts: ['picsum.photos'],
  menubar: 'file edit view insert format tools table help',
  toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
  toolbar_sticky: true,
  autosave_ask_before_unload: true,
  autosave_interval: "30s",
  autosave_prefix: "{path}{query}-{id}-",
  autosave_restore_when_empty: false,
  autosave_retention: "2m",
  image_advtab: true,
  content_css: '//www.tiny.cloud/css/codepen.min.css',
  link_list: [
    { title: 'My page 1', value: 'http://www.tinymce.com' },
    { title: 'My page 2', value: 'http://www.moxiecode.com' }
  ],
  image_list: [
    { title: 'My page 1', value: 'http://www.tinymce.com' },
    { title: 'My page 2', value: 'http://www.moxiecode.com' }
  ],
  image_class_list: [
    { title: 'None', value: '' },
    { title: 'Some class', value: 'class-name' }
  ],
  importcss_append: true,
  height: 400,
  file_picker_callback: function (callback, value, meta) {
    /* Provide file and text for the link dialog */
    if (meta.filetype === 'file') {
      callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
    }

    /* Provide image and alt text for the image dialog */
    if (meta.filetype === 'image') {
      callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
    }

    /* Provide alternative source and posted for the media dialog */
    if (meta.filetype === 'media') {
      callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
    }
  },
  templates: [
        { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
    { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
    { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
  ],
  template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
  template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
  height: 600,
  image_caption: true,
  quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
  noneditable_noneditable_class: "mceNonEditable",
  toolbar_mode: 'sliding',
  contextmenu: "link image imagetools table",
 });

  </script>
</body>
</html>