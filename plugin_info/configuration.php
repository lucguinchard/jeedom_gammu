<?php

/* This file is part of Jeedom.
*
* Jeedom is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* Jeedom is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with Jeedom. If not, see <http://www.gnu.org/licenses/>.
*/

require_once dirname(__FILE__) . '/../../../core/php/core.inc.php';
include_file('core', 'authentification', 'php');
if (!isConnect()) {
  include_file('desktop', '404', 'php');
  die();
}
?>


<form class="form-horizontal">
  <div class="form-group">
    <fieldset>

      <div id="div_local" class="form-group">
        <label class="col-lg-4 control-label">{{Clef USB}} :</label>
        <div class="col-lg-4">
          <select style="margin-top:5px" class="configKey form-control" data-l1key="nodeGateway">
            <option value="none">{{Aucun}}</option>
            <?php
            foreach (jeedom::getUsbMapping('', true) as $name => $value) {
              echo '<option value="' . $name . '">' . $name . ' (' . $value . ')</option>';
            }
            ?>

          </select>
        </div>
      </div>

      <div class="form-group">
              <label class="col-lg-4 control-label">{{PIN : }}</label>
              <div class="col-lg-4">
          <input class="configKey form-control" data-l1key="pin" style="margin-top:5px" placeholder="password" type="password"/>
              </div>
          </div>

    </div>

  </fieldset>
</form>


<script>
function gammu_postSaveConfiguration(){
  $.ajax({// fonction permettant de faire de l'ajax
  type: "POST", // methode de transmission des données au fichier php
  url: "plugins/gammu/core/ajax/gammu.ajax.php", // url du fichier php
  data: {
    action: "configuration",
  },
  dataType: 'json',
  error: function (request, status, error) {
    handleAjaxError(request, status, error);
  },
  success: function (data) { // si l'appel a bien fonctionné
  if (data.state != 'ok') {
    $('#div_alert').showAlert({message: data.result, level: 'danger'});
    return;
  }
}
});
}
</script>
</div>
</fieldset>
</form>
