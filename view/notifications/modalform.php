<?php
// file: view/layouts/modalform.php
?>
<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <div class="close">&times;</div>
      <h2><?= i18n("Add Users to notification")?></h2>
    </div>
    <div class="modal-body">
      <table id="table-content">
        <tr class="table-row-content">
          <td>
            <?= i18n("Select")?>
          </td>
          <td>
            <?= i18n("User")?>
          </td>
          <?php foreach ($users as $my_user): ?>

            <tr class="table-row-content">
              <td><a class="No_confirmation" href="index.php?controller=notifications_user&amp;action=add&amp;id_notification=<?= $notification->getId() ?>">
                <img src="resources/icons/ic_check_box_outline.svg" alt="Add"/></a>
              </td>
              <td><?= $my_user->getSurname() ?>, <?= $my_user->getName()?></td>
            </tr>
          <?php endforeach; ?>
        </table>

    </div>
    <div class="modal-footer">
      <div class="content-title">
          <a href="index.php?controller=notifications_user&amp;action=add"><input type='button' value=<?= i18n("Add")?> /></a>
      </div>
    </div>
  </div>

</div>

<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
btn.onclick = function() {
		  $('#myModal').css('display', 'flex');
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
