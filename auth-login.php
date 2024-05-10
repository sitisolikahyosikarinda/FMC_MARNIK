<?php
session_start();

require_once "../FMC/config.php";

$username = '';
$password = '';

if(isset($_POST['login'])){
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    // Your login logic here

    // Buat query SQL
    $sql = "SELECT * FROM user WHERE username=? AND password=?";
    
    // Siapkan statement SQL
    $stmt = $conn->prepare($sql);

    // Bind parameter ke query
    $stmt->bind_param("ss", $username, $password);

    // Eksekusi query
    try {
        $stmt->execute();
    } catch (mysqli_sql_exception $e) {
        // Tangani kesalahan database
        echo "Error: " . $e->getMessage();
        exit; // Hentikan eksekusi script
    }

    // Ambil hasil query
    $result = $stmt->get_result();

    // Ambil data hasil query
    $user = $result->fetch_assoc();

    // Jika user terdaftar
    if($user){
        $_SESSION["login"] = true;
        $_SESSION["user"] = $user;

     // Periksa peran pengguna
if ($user['peran'] == 'admin') {
    header("Location: Admin/admin.php");
    exit;
} elseif ($user['peran'] == 'super') {
    header("Location: Super/admin.php");
    exit;
}

        // Password salah atau user tidak terdaftar
        echo "<script>alert('Username atau password Anda salah. Silakan coba lagi!')</script>";
    }
}

?>

<?php
    $navbar = [];
?>

<head>

    <title><?php echo isset($navbar["Login"]) ? $navbar["Login"] : "Login"; ?> | FMC - Dashboard</title>

        <?php include '../FMC/layout/head.php'; ?>

        <?php include '../FMC/layout/head-style.php'; ?>

    </head>

    <?php include '../FMC/layout/body.php'; ?>

    <div class="auth-bg min-vh-100">
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="d-flex flex-column min-vh-100 px-3 pt-4">
                <div class="row justify-content-center my-auto">
                    <div class="col-md-8 col-lg-6 col-xl-5">

                       <div class="text-center mb-4">
                            <a href="index.php">
                                <img src="assets/images/logo-mobile.png" alt="" height="22"> <span class="logo-txt">FMC Marnaik</span>
                            </a>
                       </div>

                        <div class="card">
                            <div class="card-body p-4"> 
                                <div class="text-center mt-2">
                                    <h5 style="color: #C40C0C;">Welcome Admin !</h5>
                                    <p class="text-muted">Log in to continue to FMC Dashboard.</p>
                                </div>
                                <div class="p-2 mt-4">
                                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        
                                        <div class="mb-3 <?php echo (!empty($username)) ? 'has-error' : ''; ?>">
                                            <label class="form-label" for="username">Username</label>
                                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" value="<?php echo $username; ?>">
                                            <span class="text-danger"><?php echo $username; ?></span>
                                        </div>
                
                                        <div class="mb-3 <?php echo (!empty($password)) ? 'has-error' : ''; ?>">
                                            <label class="form-label" for="userpassword">Password</label>
                                            <input type="password" class="form-control" id="userpassword" name="password" placeholder="Enter password">
                                            <span class="text-danger"><?php echo $password; ?></span>
                                        </div>
                                        
                                        <div class="mt-3 text-end">
                                            <button name="login" class="btn w-sm waves-effect waves-light"  style="background-color:#C40C0C; color:white; font-weight:700;" type="submit">Log In</button>
                                        </div>
                                    </form>
                                </div>
            
                            </div>
                        </div>

                    </div><!-- end col -->
                </div><!-- end row -->

            </div>
        </div><!-- end container -->
    </div>
    </body>
</html>
