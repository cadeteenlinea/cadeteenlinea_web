<?php 
foreach ($noticias as $noticia){
?>
<p>Titulo <?php echo $noticia->titulo; ?></p>    
<p>Noticia <?php echo $noticia->cuerpo; ?></p>        
<?php    
}
?>