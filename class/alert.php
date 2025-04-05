<?php

function Alert($message, $width = '350px')
{
  $response = sprintf('<div class="container-up" id="container_up">
    <div class="container-close" onclick="click_close()"></div>
    <div class="row">
      <div class="col-md-12">

        <div class="box box-success popup" style="padding: 5px;border: 1px solid red;">
          <div class="alert alert-dismissible" style="width: %s;margin: 0;">
            <button type="button" class="close" onclick="click_close()" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4 class="text-red"><i class="icon fa fa-ban"></i> Alert!</h4>
            %s
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <script>
    function click_close() {
      $("#container_up").remove();
    }
  </script>', $width, $message);

  echo $response;
}
