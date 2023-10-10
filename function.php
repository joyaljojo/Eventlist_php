<?php
  require 'db.php';

  /**
   * sanitize
   * Sanitizes data from a form submission
   * @param array $data
   * @return array
   */
  function sanitize ($data) {
    foreach ($data as $key => $value) {
      if ($key === 'phone') {
        $value = preg_replace('/[^0-9]/', '', $value);
      } 

      $data[$key] = htmlspecialchars(stripslashes(trim($value)));
    }

    return $data;
  }


  /**
   * validate
   * Validates data from a form submission
   * @param array $data
   * @return array $errors
   */
 // functions.php

function validate($data) {
  $fields = ['title', 'email', 'date'];
  $errors = [];

  foreach ($fields as $field) {
      switch ($field) {
          case 'title':
              if (empty($data[$field])) {
                  $errors[$field] = 'Title is required';
              } elseif (strlen($data[$field]) < 5 || strlen($data[$field]) > 50) {
                  $errors[$field] = 'Title must be between 5 and 50 characters';
              }
              break;

          case 'email':
              if (empty($data[$field])) {
                  $errors[$field] = 'Email is required';
              } elseif (!filter_var($data[$field], FILTER_VALIDATE_EMAIL)) {
                  $errors[$field] = 'Email is invalid';
              }
              break;

          case 'date':
              if (empty($data[$field])) {
                  $errors[$field] = 'Date is required';
              } elseif (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $data[$field])) {
                  $errors[$field] = 'Date is invalid';
              }
              break;
      }
  }

  return $errors;
}



  /**
   * getEvents
   * Gets all events from the database
   * @return array
   */
   // Include the database connection
   require 'db.php';
  function getEvents() {
  
      global $db;  // Use the $db connection from db.php
  
      $query = "SELECT * FROM events";
      $statement = $db->query($query);
  
      // Fetch all events as an associative array
      $events = $statement->fetchAll(PDO::FETCH_ASSOC);
  
      return $events;
  }

  
  /**
   * createEvent
   * Creates an event in the database
   * @param array $data
   * @return int
   */
  function createEvent ($data) {
    global $db;  // Use the $db connection from db.php

    $query = "INSERT INTO events (title, email, date) VALUES (:title, :email, :date)";
    $statement = $db->prepare($query);

    $statement->bindValue(':title', $data['title']);
    $statement->bindValue(':email', $data['email']);
    $statement->bindValue(':date', $data['date']);

    return $statement->execute();
  }


  /**
   * deleteEvent
   * Deletes an event from the database
   * @param int $id
   * @return int
   */
  function deleteEvent ($id) {
    
      global $db;  
  
      $query = "DELETE FROM events WHERE id = :id";
      $statement = $db->prepare($query);
  
      $statement->bindValue(':id', $id);
  
      return $statement->execute();
  }
  
