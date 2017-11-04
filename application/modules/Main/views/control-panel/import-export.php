<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Импорт / Экспорт</h1>

    <div class="row import-export">
        <form id="import-form" enctype="multipart/form-data" action="control-panel/import" method="POST">
            <div class="form-group">
                <label for="input-file">Отправить этот файл:</label>
                <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
                <input type="file" class="form-control-file" id="input-file" name="userfile">
            </div>
            <input type="submit" class="btn btn-primary" value="Импортировать" />
        </form>
    </div>
</div>