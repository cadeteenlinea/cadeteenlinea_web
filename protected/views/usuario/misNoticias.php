<?php 
foreach ($noticias as $noticia){
?>
<h3><?php echo $noticia->titulo; ?></h3>    
<p><?php echo nl2br($noticia->cuerpo); ?></p>  

<?php $fecha=strftime("%d-%m-%Y", strtotime($noticia->fecha)) ; ?>
<p style="text-align: right;"><i><?php echo $fecha; ?></i></p>
<?php    
}
?>