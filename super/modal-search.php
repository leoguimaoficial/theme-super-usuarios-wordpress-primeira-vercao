


<!-- Modal -->
<div class="modal fade" id="modal-search" tabindex="-1" role="dialog" aria-labelledby="modal-searchLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">Fechar &times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img src="<?php echo img_url('pesquisa.png'); ?>" class="m-auto d-block" alt="BANNER - PESQUISAR">
         <?php get_template_part('searchform'); ?>
      </div>
    </div>
  </div>
</div>