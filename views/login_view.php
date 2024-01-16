<section class="min-vh-100 d-flex justify-content-center align-items-center bg-dark">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <h5 class="text-white text-center mt-5 mb-4">Enter your informations</h5>
                <form id="loginForm">
                    <div class="form-group">
                        <input class="form-control py-4 w-100 mb-2" name="email" type="text" placeholder="email"/>
                        <input class="form-control py-4 w-100 mb-3" name="password" type="password" placeholder="Password"/>
                    <div class="form-group">
                        <button class="btn btn-primary w-100" name="login" type="submit">Login</button>
                    </div>
                    <div class="text-center mb-4">
                        <span class="text-white-50">Don't have an account?</span>
                        <a href="index.php?page=register" class="text-primary font-weight-bold">Register here <i class="fas fa-angle-double-right"></i></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    document.getElementById('loginForm').addEventListener('submit', function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        fetch('index.php?page=login', {
            method: 'post',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                Swal.fire({
                    title: 'Success!',
                    text: 'Login successful',
                    icon: 'success'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = data.message;
                    }
                });
            } else {
                Swal.fire({
                    title: 'Error!',
                    text: data.message,
                    icon: 'error'
                });
            }
        })
        .catch(error => {
            Swal.fire({
                title: 'Error!',
                text: 'An error occurred: ' + error,
                icon: 'error'
            });
        });
    });
</script>
