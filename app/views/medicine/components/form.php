<div class="col-md-12">
    <input class="form-control" type="text" name="name" placeholder="Medicine name" maxlength="25" required
        <?php if(isset($name)) { ?> value="<?php echo $name;} ?>">
    <?php 
    if(isset($error_messages['name'])) {
        echo "<div class='invalid'>";
    foreach ($error_messages['name'] as $error_message) {
        echo "<p>$error_message</p>";
    }
        echo "</div>";} 
    ?>
</div>
<div class="row">
    <div class="col-md-6">
        <input class="form-control" type="number" name="dosage" placeholder="Quantity dosage" min="1" max="1000"
            required <?php if(isset($dosage_qt)) { ?> value="<?php echo $dosage_qt;} ?>">
        <?php 
    if(isset($error_messages['dosage_qt'])) {
        echo "<div class='invalid'>";
    foreach ($error_messages['dosage_qt'] as $error_message) {
        echo "<p>$error_message</p>";
    }
        echo "</div>";} 
    ?>
    </div>
    <div class="col-md-6 m-0">
        <select id="dosage_unit" name="dosage_unit" required>
            <option value="mg" <?php if(isset($dosage_unit) && $dosage_unit === "mg") { echo "selected"; } ?>>mg
            </option>
            <option value="g" <?php if(isset($dosage_unit) && $dosage_unit === "g") { echo "selected"; } ?>>g</option>
            <option value="ml" <?php if(isset($dosage_unit) && $dosage_unit === "ml") { echo "selected"; } ?>>ml
            </option>
            <option value="unit" <?php if(isset($dosage_unit) && $dosage_unit === "unit") { echo "selected"; } ?>>
                unit(s)</option>
            <option value="tablet" <?php if(isset($dosage_unit) && $dosage_unit === "tablet") { echo "selected"; } ?>>
                tablet(s)</option>
            <option value="capsule" <?php if(isset($dosage_unit) && $dosage_unit === "capsule") { echo "selected"; } ?>>
                capsule(s)</option>
            <option value="drop" <?php if(isset($dosage_unit) && $dosage_unit === "drop") { echo "selected"; } ?>>
                drop(s)</option>
        </select>
        <?php 
    if(isset($error_messages['dosage_unit'])) {
        echo "<div class='invalid'>";
    foreach ($error_messages['dosage_unit'] as $error_message) {
        echo "<p>$error_message</p>";
    }
        echo "</div>";} 
    ?>
    </div>
</div>
<div class="col-md-12">
    <input class="form-control" type="text" name="frequency" placeholder="Frequency" maxlength="50" required
        <?php if(isset($frequency)) { ?> value="<?php echo $frequency;} ?>">
    <?php 
    if(isset($error_messages['frequency'])) {
        echo "<div class='invalid'>";
    foreach ($error_messages['frequency'] as $error_message) {
        echo "<p>$error_message</p>";
    }
        echo "</div>";} 
    ?>
</div>
<?php 
    if(isset($error_messages['medicine'])) {
        echo "<div class='invalid'>";
    foreach ($error_messages['medicine'] as $error_message) {
        echo "<p>$error_message</p>";
    }
        echo "</div>";} 
    ?>