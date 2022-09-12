<section class="py-16 ">
    <a href="index.php" class="text-blue-500 text-sm">
        <- retour </a>
            <?php $main_title = "Ajouter un utilisateur";
            include("_h1.php")
            ?>
            <form action="" method="POST" class="grid place-items-center bg-gray-100 mx-96 py-10 my-16 gap-y-4 rounded-xl" enctype="multipart/form-data">
                <!--input name  -->
                <div class="mb-4">
                    <label for="name" class="font-semibold text-blue-500">name</label>
                    <input type="text" name="name" class="input input-bordered w-full max-w-xs block" value="<?php
                                                                                                                if (!empty($_POST["name"])) {
                                                                                                                    echo $_POST["name"];
                                                                                                                } ?>" />
                    <p>
                        <?php
                        if (!empty($error["name"])) {
                            echo $error["name"];
                        }
                        ?>
                    </p>
                </div>

                <!--input email  -->
                <div class="mb-4">
                    <label for="email" class="font-semibold text-blue-500">email</label>
                    <input type="text" name="email" class="input input-bordered w-full max-w-xs block" value="<?php
                                                                                                                if (!empty($_POST["email"])) {
                                                                                                                    echo $_POST["email"];
                                                                                                                } ?>" />
                    <p>
                        <?php
                        if (!empty($error["email"])) {
                            echo $error["email"];
                        }
                        ?>
                    </p>
                </div>

                <!--input password  -->
                <div class="mb-4">
                    <label for="password" class="font-semibold text-blue-500">password</label>
                    <input type="text" name="password" class="input input-bordered w-full max-w-xs block" value="<?php
                                                                                                                    if (!empty($_POST["password"])) {
                                                                                                                        echo $_POST["password"];
                                                                                                                    } ?>" />
                    <p>
                        <?php
                        if (!empty($error["password"])) {
                            echo $error["password"];
                        }
                        ?>
                    </p>
                </div>

                <!-- submit btn -->
                <div class="py-5">
                    <input type="submit" name="submited" value="Ajouter" class="btn btn-active btn-primary">
                </div>
            </form>
</section>