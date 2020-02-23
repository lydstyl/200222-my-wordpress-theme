<form action="/wordpress/" method="get"> <!-- action should be "/" instead of "/wordpress/" -->
  <label for="search">Search</label>
  <!-- <input type="hidden" name="cat" value="3"> only for id 3 for this exemple -->
  <input type="text" name="s" id="search" value="<?= the_search_query() ?>" required>
  <input type="submit" value="Search!">
</form>