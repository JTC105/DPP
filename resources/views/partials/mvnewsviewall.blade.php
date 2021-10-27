<!-- Modal-->
<div id="newsViewAllMV" tabindex="-1" role="dialog" aria-labelledby="newsViewMVLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title">News Bulletin</h4>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>

      <div class="modal-body">
  
          <div class="table-responsive">                       
                  <table class="table table-striped table-hover" id="newsTable">
                    <thead>
                      <tr>
                        <th>Visible</th>
                        <th>News Item</th>
                        <th>Creator</th>
                        <th class="column-fifteenperc">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if($data['newsall'] != null)
                      @foreach($data['newsall'] as $d)
                      <tr>
                        <td scope="row">
                          @if($d->is_visible == 1)
                            <i class="fas fa-eye"></i>
                          @else
                            <i class="fas fa-eye-slash"></i>
                          @endif
                        </td>
                        <td>
                          <b>{{$d->title}}</b><p data-info="{{$d->id}}">{{$d->content}}</p>
                        </td>
                        <td>{{$d->creator}}</td>
                        <td class="column-fifteenperc">
                          @permission("dash-news-edit")
                          {{-- @if(auth()->user()->username == $d->creator) --}}
                            <button type="button" data-toggle="modal" data-target="#newsEditMV" class="btn btn-primary editNewsBulletin" data-info="{{$d->id}}" rel="tooltip" title="Edit News"><i class="fas fa-edit"></i></button>
                          {{-- @endif --}}
                          @endpermission
                         
                        </td>
                      </tr>
                      @endforeach
                      @endif
                    </tbody>

                  </table>
                  <br /><br />
                </div>

      </div>

      <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
      </div>
      
    </div>
  </div>
</div>


