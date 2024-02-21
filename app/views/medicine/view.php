<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="header.css">
    <title>Medicines</title>
</head>

<body>
    <?php 
include('../views/components/header.php');

?>
    <div class="container">
        <div class="row mt-2">
            <div class="col-12 d-flex align-items-center">
                <h1>Medicine List</h1>
                <a class="btn btn-warning ms-2" href="account/add" role="button"><i class="bi bi-plus-circle"></i>
                    ADD</a>
            </div>
            <div class="col-12 mt-2">
                <?php if (!empty($medicines)): ?>
                <table class="table table-dark table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Dosage</th>
                            <th scope="col">Frequency</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php foreach ($medicines as $medicine): ?>
                        <tr>
                            <td><?php echo $medicine['name']; ?></td>
                            <td><?php echo $medicine['dosage']; ?></td>
                            <td><?php echo $medicine['frequency']; ?></td>
                            <td><?php echo date('d/m/Y', strtotime($medicine['created_at'])); ?></td>
                            <td><a class="btn btn-warning ms-2"
                                    href="account/update?id=<?php echo $medicine['id'];?>"><i
                                        class="bi bi-pencil-square"></i> Edit</a>
                                <a class="btn btn-warning ms-2" href="account/delete?id=<?php echo $medicine['id']; ?>"
                                    onclick="return confirm('You gonna delete <?php echo $medicine['name']; ?>, are you sure?')"><i
                                        class="bi bi-trash"></i> Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                <p>No medicines found.</p>
                <?php endif; ?>
            </div>

        </div>
    </div>

</body>

</html>