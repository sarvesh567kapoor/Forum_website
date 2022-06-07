<?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']= true)
    {
          echo '<h2 class="py-2">Post a Comment</h2>
          <form action="'. $_SERVER['REQUEST_URI'] .'" method="post">
              <div class="mb-3">
                  <label for="exampleFormControlTextarea1" class="form-label">Type your Comment</label>
                  <textarea name="comment" class="form-control" id="comment" rows="3"></textarea>
              </div>
              <button type="submit" class="btn btn-success">Post Comment</button>
          </form>';
    }
    else {

        echo '<h2>Post a Comment</h2>
        <p class="lead">You are not logged in. Please login to Post a Comment</p>';
    }
      ?> 