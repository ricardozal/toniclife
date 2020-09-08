<div class="d-flex flex-column align-items-center mb-5">
    <h4 class="text-header mt-2">Modificar enlace</h4>
</div>
<div class="row">
    <form id="form-upsert" action="{{route('admin_app_mobile_content_update_post',['contentId' => $content->id])}}"
          class="d-flex flex-column align-items-center w-100"
          method="post">
        @csrf

        <div class="row w-75">
            <div class="col-12">
                <p>Enlace: <span class="font-weight-bold">{{$content->name}}</span></p>
                <p>Tipo: <span class="font-weight-bold">{{$content->type}}</span></p>
            </div>
        </div>

        @if($content->type == 'pdf')
            <div class="row w-75">
                <div class="col-12">
                    <div class="form-group">
                        <input id="inp-pdf" name="file" type="file" class="custom-file-input">
                        <label class="inp-file-msg">Archivo pdf</label>
                        <label id="lbl-pdf" class="custom-file-label focused  {{ $errors->has('file') ? ' is-invalid' : '' }}"
                               for="inp-pdf">
                        </label>
                        <span class="invalid-feedback">{{ $errors->first('file') }}</span>
                    </div>
                </div>
            </div>
            @elseif($content->type == 'url' && $content->key != 'WHATSAPP')
            <div class="row w-75">
                <div class="col-12">
                    <div class="form-group focused">
                        <label for="url" class="focused form-label">Enlace (URL)</label>
                        <input type="text" class="form-control" autocomplete="off" id="url" name="url" value="{{ isset($content) ? $content->url : null}}">
                        <span class="invalid-feedback">{{ $errors->first('url') }}</span>
                    </div>
                </div>
            </div>
            @elseif($content->type == 'url' && $content->key == 'WHATSAPP')
            <div class="row w-75">
                <div class="col-12">
                    <div class="form-group focused">
                        <label for="phone" class="focused form-label">Teléfono</label>
                        <input type="text" class="form-control" autocomplete="off" id="phone" name="phone" value="{{ isset($content) ? $content->url : null}}">
                        <span class="invalid-feedback">{{ $errors->first('url') }}</span>
                    </div>
                </div>
            </div>
            @endif
        <div class="form-group text-center w-75">
            <button type="submit" class="btn btn-primary">
                Guardar
            </button>
        </div>
    </form>
</div>
