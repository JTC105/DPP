<!-- Modal-->
<div id="modalLevel2UserPerm" tabindex="-1" role="dialog" aria-labelledby="modalLevel2UserPermLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h4 id="modalLevel2UserPermLabel" class="modal-title">Level 2 User Permission <span id="unameLP2" class="badge badge-pill">...</span></h4>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>

      <form class="form-horizontal" method="POST" action="/admin/userupdatel2perm">
      {{ csrf_field() }}

      <div class="modal-body">  
          <input type="hidden" id="uidLP2" name="uidLP2">
          <input type="hidden" id="uroleLP2" name="uroleLP2">

          <!-- Permission Allowed -->
          <div id="permissionsContainer">

            <div class="form-group row">
              <div class="col-sm-12">
                <b>CONTRACT</b>
              </div>
            </div>

           <div class="form-group row">
            <div class="col-sm-3">
              <input id="roleL2_1" name="roleL2[]" type="checkbox" class="form-control-custom" value="contract-view-list">
              <label for="roleL2_1" class="checkbox-custom-label role-label"> View List</label>
            </div>

            <div class="col-sm-3">
              <input id="roleL2_2" name="roleL2[]" type="checkbox" class="form-control-custom" value="contract-view-det">
              <label for="roleL2_2" class="checkbox-custom-label role-label"> View Details</label>
            </div>

            <div class="col-sm-3">
              <input id="roleL2_3" name="roleL2[]" type="checkbox" class="form-control-custom" value="contract-add">
              <label for="roleL2_3" class="checkbox-custom-label role-label"> Add</label>
            </div>

            <div class="col-sm-3">
              <input id="roleL2_4" name="roleL2[]" type="checkbox" class="form-control-custom" value="contract-edit">
              <label for="roleL2_4" class="checkbox-custom-label role-label"> Edit</label>
            </div>
          </div>

          <div class="form-group row">          
            <div class="col-sm-3">
              <input id="roleL2_5" name="roleL2[]" type="checkbox" class="form-control-custom" value="contract-printprev">
              <label for="roleL2_5" class="checkbox-custom-label role-label"> Print Preview</label>
            </div>

            <div class="col-sm-3">
              <input id="roleL2_6" name="roleL2[]" type="checkbox" class="form-control-custom" value="contract-print">
              <label for="roleL2_6" class="checkbox-custom-label role-label"> Print </label>
            </div>

            <div class="col-sm-3">
              <input id="roleL2_7" name="roleL2[]" type="checkbox" class="form-control-custom" value="contract-upload-log">
              <label for="roleL2_7" class="checkbox-custom-label role-label"> Upload Documents</label>
            </div>
          </div>

          <div class="line"></div>

            <div class="form-group row">
              <div class="col-sm-12">
                <b>APPROVED CONTRACT</b>
              </div>
            </div>

           <div class="form-group row">
            <div class="col-sm-3">
              <input id="roleL2_8" name="roleL2[]" type="checkbox" class="form-control-custom" value="approve-con-view-list">
              <label for="roleL2_8" class="checkbox-custom-label role-label"> View List</label>
            </div>

            <div class="col-sm-3">
              <input id="roleL2_9" name="roleL2[]" type="checkbox" class="form-control-custom" value="approve-con-view-det">
              <label for="roleL2_9" class="checkbox-custom-label role-label"> View Details</label>
            </div>

            <div class="col-sm-3">
              <input id="roleL2_10" name="roleL2[]" type="checkbox" class="form-control-custom" value="approve-con-add">
              <label for="roleL2_10" class="checkbox-custom-label role-label"> Add</label>
            </div>
          </div>

          <div class="line"></div>

          <div class="form-group row">
              <div class="col-sm-12">
                <b>SIGNATORIES</b>
              </div>
            </div>

           <div class="form-group row">
            <div class="col-sm-3">
              <label class="role-label"><i>Local</i></label>
            </div>

            <div class="col-sm-3">
              <input id="roleL2_11" name="roleL2[]" type="checkbox" class="form-control-custom" value="signa-loc-view-list">
              <label for="roleL2_11" class="checkbox-custom-label role-label"> View List</label>
            </div>

            <div class="col-sm-3">
              <input id="roleL2_12" name="roleL2[]" type="checkbox" class="form-control-custom" value="signa-loc-add">
              <label for="roleL2_12" class="checkbox-custom-label role-label"> Add</label>
            </div>

            <div class="col-sm-3">
              <input id="roleL2_13" name="roleL2[]" type="checkbox" class="form-control-custom" value="signa-loc-edit">
              <label for="roleL2_13" class="checkbox-custom-label role-label"> Edit</label>
            </div>
          </div>

          <div class="form-group row">
            <div class="col-sm-3">
              <label class="role-label"><i>TFSPH</i></label>
            </div>

            <div class="col-sm-3">
              <input id="roleL2_14" name="roleL2[]" type="checkbox" class="form-control-custom" value="signa-tfsph-view-list">
              <label for="roleL2_14" class="checkbox-custom-label role-label"> View List</label>
            </div>

            <div class="col-sm-3">
              <input id="roleL2_15" name="roleL2[]" type="checkbox" class="form-control-custom" value="signa-tfsph-add">
              <label for="roleL2_15" class="checkbox-custom-label role-label"> Add</label>
            </div>

            <div class="col-sm-3">
              <input id="roleL2_16" name="roleL2[]" type="checkbox" class="form-control-custom" value="signa-tfsph-edit">
              <label for="roleL2_16" class="checkbox-custom-label role-label"> Edit</label>
            </div>            
          </div>

          <div class="form-group row">
            <div class="col-sm-3">
            </div>
            <div class="col-sm-3">
              <input id="roleL2_17" name="roleL2[]" type="checkbox" class="form-control-custom" value="signa-tfsph-assign">
              <label for="roleL2_17" class="checkbox-custom-label role-label"> ASSIGN</label>
            </div>
          </div>

          <div class="line"></div>

            <div class="form-group row">
              <div class="col-sm-12">
                <b>FORM TEMPLATE</b>
              </div>
            </div>

           <div class="form-group row">
            <div class="col-sm-3">
              <input id="roleL2_18" name="roleL2[]" type="checkbox" class="form-control-custom" value="form-temp-view-list">
              <label for="roleL2_18" class="checkbox-custom-label role-label"> View List</label>
            </div>

            <div class="col-sm-3">
              <input id="roleL2_19" name="roleL2[]" type="checkbox" class="form-control-custom" value="form-temp-add">
              <label for="roleL2_19" class="checkbox-custom-label role-label"> Add</label>
            </div>

            <div class="col-sm-3">
              <input id="roleL2_20" name="roleL2[]" type="checkbox" class="form-control-custom" value="form-temp-edit">
              <label for="roleL2_20" class="checkbox-custom-label role-label"> Edit</label>
            </div>

            <div class="col-sm-3">
              <input id="roleL2_21" name="roleL2[]" type="checkbox" class="form-control-custom" value="form-temp-print">
              <label for="roleL2_21" class="checkbox-custom-label role-label"> Print</label>
            </div>
          </div>

          <div class="line"></div>

            <div class="form-group row">
              <div class="col-sm-12">
                <b>CHEQUE WRITER</b>
              </div>
            </div>

           <div class="form-group row">
            <div class="col-sm-3">
              <input id="roleL2_22" name="roleL2[]" type="checkbox" class="form-control-custom" value="cwriter-encode">
              <label for="roleL2_22" class="checkbox-custom-label role-label"> Encode</label>
            </div>

            <div class="col-sm-3">
              <input id="roleL2_23" name="roleL2[]" type="checkbox" class="form-control-custom" value="cwriter-preview">
              <label for="roleL2_23" class="checkbox-custom-label role-label"> Preview</label>
            </div>

            <div class="col-sm-3">
              <input id="roleL2_24" name="roleL2[]" type="checkbox" class="form-control-custom" value="cwriter-print">
              <label for="roleL2_24" class="checkbox-custom-label role-label"> Print</label>
            </div>
          </div>

          <div class="line"></div>

          <div class="form-group row">
              <div class="col-sm-12">
                <b>USERS</b>
              </div>
            </div>

           <div class="form-group row">
            <div class="col-sm-3">
              <label class="role-label"><i>Level 3</i></label>
            </div>

            <div class="col-sm-3">
              <input id="roleL2_25" name="roleL2[]" type="checkbox" class="form-control-custom" value="ulevel3-view-list">
              <label for="roleL2_25" class="checkbox-custom-label role-label"> View List</label>
            </div>

            <div class="col-sm-3">
              <input id="roleL2_26" name="roleL2[]" type="checkbox" class="form-control-custom" value="ulevel3-add">
              <label for="roleL2_26" class="checkbox-custom-label role-label"> Add</label>
            </div>

            <div class="col-sm-3">
              <input id="roleL2_27" name="roleL2[]" type="checkbox" class="form-control-custom" value="ulevel3-edit">
              <label for="roleL2_27" class="checkbox-custom-label role-label"> Edit</label>
            </div>
          </div>

          <div class="form-group row">
            <div class="col-sm-3">
              <label class="role-label"><i>Dealer</i></label>
            </div>

            <div class="col-sm-3">
              <input id="roleL2_28" name="roleL2[]" type="checkbox" class="form-control-custom" value="udealer-view-list">
              <label for="roleL2_28" class="checkbox-custom-label role-label"> View List</label>
            </div>

            <div class="col-sm-3">
              <input id="roleL2_29" name="roleL2[]" type="checkbox" class="form-control-custom" value="udealer-add">
              <label for="roleL2_29" class="checkbox-custom-label role-label"> Add</label>
            </div>

            <div class="col-sm-3">
              <input id="roleL2_30" name="roleL2[]" type="checkbox" class="form-control-custom" value="udealer-edit">
              <label for="roleL2_30" class="checkbox-custom-label role-label"> Edit</label>
            </div>            
          </div>

          <div class="line"></div>

            <div class="form-group row">
              <div class="col-sm-12">
                <b>VEHICLES</b>
              </div>
            </div>

           <div class="form-group row">
            <div class="col-sm-3">
              <input id="roleL2_31" name="roleL2[]" type="checkbox" class="form-control-custom" value="vehicle-view-list">
              <label for="roleL2_31" class="checkbox-custom-label role-label"> View List</label>
            </div>

            <div class="col-sm-3">
              <input id="roleL2_32" name="roleL2[]" type="checkbox" class="form-control-custom" value="vehicle-add">
              <label for="roleL2_32" class="checkbox-custom-label role-label"> Add</label>
            </div>

            <div class="col-sm-3">
              <input id="roleL2_33" name="roleL2[]" type="checkbox" class="form-control-custom" value="vehicle-edit">
              <label for="roleL2_33" class="checkbox-custom-label role-label"> Edit</label>
            </div>
          </div>

          <div class="line"></div>

            <div class="form-group row">
              <div class="col-sm-12">
                <b>CITY/MUNICIPALITY</b>
              </div>
            </div>

           <div class="form-group row">
            <div class="col-sm-3">
              <input id="roleL2_34" name="roleL2[]" type="checkbox" class="form-control-custom" value="cm-view-list">
              <label for="roleL2_34" class="checkbox-custom-label role-label"> View List</label>
            </div>

            <div class="col-sm-3">
              <input id="roleL2_35" name="roleL2[]" type="checkbox" class="form-control-custom" value="cm-add">
              <label for="roleL2_35" class="checkbox-custom-label role-label"> Add</label>
            </div>

            <div class="col-sm-3">
              <input id="roleL2_36" name="roleL2[]" type="checkbox" class="form-control-custom" value="cm-edit">
              <label for="roleL2_36" class="checkbox-custom-label role-label"> Edit</label>
            </div>
          </div>

          <div class="line"></div>

            <div class="form-group row">
              <div class="col-sm-12">
                <b>DEALER FEES</b>
              </div>
            </div>

           <div class="form-group row">
            <div class="col-sm-3">
              <input id="roleL2_37" name="roleL2[]" type="checkbox" class="form-control-custom" value="dfees-view-list">
              <label for="roleL2_37" class="checkbox-custom-label role-label"> View List</label>
            </div>

            <div class="col-sm-3">
              <input id="roleL2_38" name="roleL2[]" type="checkbox" class="form-control-custom" value="dfees-add">
              <label for="roleL2_38" class="checkbox-custom-label role-label"> Add</label>
            </div>

            <div class="col-sm-3">
              <input id="roleL2_39" name="roleL2[]" type="checkbox" class="form-control-custom" value="dfees-edit">
              <label for="roleL2_39" class="checkbox-custom-label role-label"> Edit</label>
            </div>            
          </div>

          <div class="form-group row">    
            <div class="col-sm-3">
              <input id="roleL2_40" name="roleL2[]" type="checkbox" class="form-control-custom" value="dfees-tableref-view-list">
              <label for="roleL2_40" class="checkbox-custom-label role-label"> View Tables</label>
            </div>

            <div class="col-sm-3">
              <input id="roleL2_41" name="roleL2[]" type="checkbox" class="form-control-custom" value="dfees-tableref-add">
              <label for="roleL2_41" class="checkbox-custom-label role-label"> Add Range</label>
            </div>

            <div class="col-sm-3">
              <input id="roleL2_42" name="roleL2[]" type="checkbox" class="form-control-custom" value="dfees-tableref-edit">
              <label for="roleL2_42" class="checkbox-custom-label role-label"> Edit Range </label>
            </div>

          </div>
          

          </div>
          <!-- end PA -->

      </div>

      <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      
      </form>

    </div>
  </div>
</div>


