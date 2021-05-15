<form method="post" action="" id="contactForm">
    <div class="centrarlog">
        <label>
            <h5><i class="fa fa-envelope"></i> Enviar mensaje</h5>
        </label>
        <div class="form-group">
            <span><i class="fa fa-user bigicon"></i></span>
            <input type="text" class="form-control" placeholder="First Name" name="nombre" required />
        </div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Last Name" name="ape" required />
        </div>
        <div class="form-group">
            <span><i class="fa fa-envelope-o bigicon"></i></span>
            <input type="email" class="form-control" placeholder="Email Address" name="mail" required />
        </div>
        <div class="form-group">
            <span><i class="fa fa-phone-square bigicon"></i></span>
            <input type="number" minlenght="9" maxlenght="9" class="form-control" placeholder="Phone" name="tel"
                required />
        </div>
        <div class="form-group">
            <span><i class="fa fa-pencil-square-o bigicon"></i></span>
            <textarea class="form-control" id="message" name="message"
                placeholder="Enter your message for us here. We will get back to you within 2 business days." rows="7"
                required></textarea>
        </div>
        <div class="form-group">
            <button class="btn btn-submit&&btn btn-dark" type="submit"><i class="fas fa-paper-plane"
                    style="background:transparent; color:white;"> </i> Enviar</button>
        </div>
    </div>
</form>

<script>
$("#contactForm").submit(function(event) {
    // Prevent default posting of form - put here to work in case of errors
    event.preventDefault();

    var formData = new FormData(this);

    formData.append('action', 'email');


    $.ajax({
        url: "configs/manejar_bbdd.php",
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            loadingOn();
        },
        success: function(data) {
            loadingOf();
            toast("Se ha enviado correctamente");
        },
    });

});
</script>