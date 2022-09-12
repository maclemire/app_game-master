<div class="pt-16 wrap_content">
    <!-- head content -->
    <div class="wrap_content-head text-center">
        <?php $main_title = "App Game";
        include("_h1.php")
        ?>
        <p class="pt-5">L'app qui répertorie vos jeux</p>

        <!--Add User -->
        <div class="pt-16 pb-16">
            <a href="userCreate.php" class="btn bg-blue-500">Ajouter un User</a>
        </div>


        <?php require_once("_alert.php") ?>

    </div>
    <!-- table-->
    <div class="overflow-x-auto mt-16 mb-16">
        <table class="table w-full ">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>E-Mail</th>
                    <th>Voir</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $index = 1;
                if (count($users) == 0) {
                    echo " <tr><td class='text-center'> There are no users</td> </tr>";
                } else { ?>
                    <?php foreach ($users as $user) : ?>
                        <tr class="hover:text-blue-500 ">
                            <th class="text-blue-500 font-black"> <?= $index++ ?> </th>
                            <td><?= $user['name'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td>
                                <a href="showUser.php?id=<?= $user['id'] ?>&name=<?= $user['name'] ?>">
                                    <img src="public/img/oeil.png" alt="eye" class="w-4">
                                </a>
                            </td>
                            <td><a href="UserUpdate.php?id=<?= $user['id'] ?>&name=<?= $user['name'] ?>" class="btn btn-success text-white">Modifier</a></td>
                            <td><?php include("_modal.php") ?></td>
                        </tr>
                    <?php endforeach ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>