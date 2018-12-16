<?$model = (object)$model;?>
<h2>Url Kısalt (Beta Yayını)</h2>
<div class="alert alert-info">Kısaltmak istediğiniz urlyi aşağıdaki kutucuğa yapıştırın ve "Kısalt!" düğmesine basın.</div>
<form action="/home/index" method="post" id="sendURL">
    <!-- TODO: AntiForgeryToken()-->
    <div class="form-group">
        <label for="url">URL:</label>
        <input class="form-control" type="text" name="url" id="url" value="<?echo $model->url?>" />
    </div>

    <div>
        <script type="text/javascript" src="//www.google.com/recaptcha/api.js?hl=tr" async>
        </script>
        <div class="g-recaptcha" data-sitekey="6Le9gR4TAAAAANaCR1mQu3eJpy9z0XAaWTqGn9_o" data-theme="light" data-type="image">
        </div>
        <span class="field-validation-valid" data-valmsg-for="ReCaptcha" data-valmsg-replace="true"></span>
    </div>
    <input type="submit" class="btn btn-primary" id="submitUleynnnn" value="Kısalt!" />
</form>
<div id="result">
<?
    if ($model != null)
    {
        if (!str::isNullOrEmpty($model->message))
        {
            echo
            '<div class="alert alert-'.($model->success ? "success" : "danger").'">'.
                $model->message.
            '</div>';
        }

    }
?>
</div>

<script type="text/javascript">

    var isSubmitting = false;
    $("#sendURL").bind('submit', function (e) {
        if (isSubmitting) {
            e.preventDefault();
            $("#result").html("İşlem devam ediyor bekleyiniz...");
        } else {
            isSubmitting = true;
            $('#submitUleynnnn').attr('disabled', 'disabled');
            $('#submitUleynnnn').val("İşleniyor...");

        }

    });
</script>
<!--
@*$('#Button').attr('disabled','disabled');
    Enabling a html button

    $('#Button').removeAttr('disabled');*@

@*<img src="~/Content/general/yapim_asamasinda.png" />
    <br />
    <a href="@Url.Action("SMSBilgilendirme","WebIletisim")">Gelişmelerden haberdar olmak için tıklayın</a>*@
-->