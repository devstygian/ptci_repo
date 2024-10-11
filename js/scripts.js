$(document).ready(function () {
  $("#mainContent").load("./try/home.php");

  // male
  $("#maleUniformLink").on("click", function (event) {
    event.preventDefault();
    $("#mainContent").load("./maleCandidates/maleUniform.php");
  });

  $("#maleSwimwearLink").on("click", function (event) {
    event.preventDefault();
    $("#mainContent").load("./maleCandidates/maleSwimwear.php");
  });

  $("#maleFormalWalkLink").on("click", function (event) {
    event.preventDefault();
    $("#mainContent").load("./maleCandidates/maleFormalWalk.php");
  });

  $("#maleTalentLink").on("click", function (event) {
    event.preventDefault();
    $("#mainContent").load("./maleCandidates/maleTalent.php");
  });

  // Female
  $("#femaleUniformLink").on("click", function (event) {
    event.preventDefault();
    $("#mainContent").load("./femaleCandidates/femaleUniform.php");
  });

  $("#femaleSwimwearLink").on("click", function (event) {
    event.preventDefault();
    $("#mainContent").load("./femaleCandidates/femaleSwimwear.php");
  });

  $("#femaleFormalWalkLink").on("click", function (event) {
    event.preventDefault();
    $("#mainContent").load("./femaleCandidates/femaleFormalWalk.php");
  });

  $("#femaleTalentLink").on("click", function (event) {
    event.preventDefault();
    $("#mainContent").load("./femaleCandidates/femaleTalent.php");
  });

  // Other Links
  $("#rulesLink").on("click", function (event) {
    event.preventDefault();
    $("#mainContent").load("./try/rules.php");
  });

  $("#homeLink").on("click", function (event) {
    event.preventDefault();
    $("#mainContent").load("./try/home.php");
  });
});
