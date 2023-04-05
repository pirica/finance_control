<?php
require_once("templates/header_iframe.php");

$images = array(
   "1" => "finance_login.gif",
   "2" => "validate_register_form.gif",
   "3" => "finance_logo.png",
);

?>

<button class="btn btn-outline-success" data-toggle="modal" data-target=".bd-lessons1">
   modal1
</button>
<button class="btn btn-outline-success" data-toggle="modal" data-target=".bd-lessons2">
   modal2
</button>
<button class="btn btn-outline-success" data-toggle="modal" data-target=".bd-lessons3">
   modal3
</button>

<?php foreach ($images as $key => $item) :
   echo '<div class="modal fade bd-lessons'.$key.'" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-xl" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <div class="modal-body">
               <div>
                   <img class="animated-gif" src="'.$BASE_URL.'assets/'.$item.'" alt="Example gif">
               </div>
           </div>
           <div class="modal-footer mx-auto">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
           </div>
       </div>
   </div>
</div>
<!-- Modal Lessons  -->
 ';

endforeach;
?>
<?php require_once("templates/footer.php"); ?>