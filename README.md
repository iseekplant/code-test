# iseekplant post-a-job

Post-a-job is a tool that allows users to post a new job on the iseekplant platform. Your job is to perform upgrades
and maintenance of this tool.

Installation Instructions:

1. You will need PHP 8.2 and a recent version of Node/NPM installed
2. Clone this repository
3. Setup the project by running `composer run setup`
4. Start the Vite dev server by running `npm run dev`
5. Run it with `php artisan serve`

How to Complete the Tasks:

1. Create a new branch, and call it your name. For example: `git checkout -b joe-blogs`
2. Commit each task to your branch. Use a descriptive commit message detailing the work you've completed. There should be one and only one commit per task. If you make commits along the way, be sure to squash them
3. All tests must pass at each commit, including any new tests you have added.
4. Once you have finished, create a tarball of the entire folder, including the git history and email to greg@iseekplant.com.au

You should aim to spend no more than 3h on this work. Make sure you complete the steps in order. 
If you are not able to complete all the tasks in the allotted time, please commit the work you have done, and submit the assessment as is with notes on how far you got. 

## Task 1. Fix a user reported error

A user has reported that they are unable to search for their job on the index page when they search by their email address

* Write a test to replicate the bug
* Correct the bug and have the test pass

## Task 2. Introduce a phone number validator

Users can currently enter any value they wish into the phone number field. This project has the `giggsey/libphonenumber-for-php` package installed.

* Write a PHPUnit test for validating valid and invalid phone numbers
* Write a validator that requires that only valid AU phone numbers can be submitted

## Task 3. Display validation errors

A user has reported that when entering an invalid phone number, they are not provided with feedback to that effect. 

* Write a vitest test to ensure that validation errors are displayed if the form is in an invalid state
* Implement a validation message

## Task 4. Update the job edit route to use a UUID in the URL instead of a job ID

* Using PHPUnit tests, ensure that jobs are assigned a `uuid` when they are stored
* Add a migration to add a `uuid` to each `jobs` record
* Update PHPUnit tests that route to the edit job route, to use a UUID, instead of an ID
* Use the `uuid` as the route model binding key for the edit job route
* Update vitest tests that create links to the job edit page, to use a UUID instead of an ID

## Task 5. Add pagination to the jobs index

* Using PHPUnit tests, ensure that the jobs sent to the jobs index are paginated
* You can use eloquent query builder pagination
* Using vitest tests, ensure that pagination links are displayed

## Task 6. Add responsive styling for the jobs index and the job form

The UI does not display well on mobile devices. 
Implement a responsive layout so that both desktop and mobile screens are supported.

One example of a mobile-friendly layout is described below, but feel free to implement your own:

In the job form:

* Display field labels on their own line
* Make all fields full width (with some reasonable padding around the page content)

In the jobs index:

* Hide the column headings
* For each row, stack the columns vertically
* Display a dividing line/border between each

## Task 7. Add an artisan command "jobs:export-csv" that generates a csv file containing job information

We need a CSV export of all the jobs in the system.

* Using PHPUnit tests, ensure that the command runs and outputs the correct file
* The file should contain all the jobs, and the following headings: Contact Name, Contact Phone, Contact Email, Location, Details
* Store the file in the default filesystem (`./storage/app/...`) using the current date as the filename (e.g. 2023-08-07.csv)

## Task 8. Allow a user to close a job

Users can currently not close a job, meaning that they will continue to be alerted even after the job is no longer relevant.
A job should not be editable after it has been closed.

* Implement a close job feature on the edit page
* Using PHPUnit tests, prove that a closed job will not have a notification sent
* Use vitest tests to verify that a closed job is not editable, and PHPUnit tests to prove that attempts to edit a closed job will fail
