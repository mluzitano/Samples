# Samples
Work samples demonstrating skills in Drupal 7 &amp; 8

The intent of this repository is to demonstrate my skills as a Drupal developer. Work related to Wordpress, PHP, etc. are available upon request.

Note that client names have been redacted thoroughly throughout the code. The code samples are as follows:

##d8theme and d7theme
 - A demonstration of a Drupal 8 theme and a Drupal 7 theme, respectively
 - Both themes are built in the following fashion:
   - Built with Sass and Grunt (via Node)
   - Built on Bootstrap
   - Demonstrates use of Bootstrap, flexbox, CSS3 attributes, etc.

##d8modules
 - A suite of tools for interacting with the SOAP API provided by NetForum
 - Demonstrates understanding of:
   - Drupal 8 Custom
   - Building and using services
   - Proper dependency injection via __construct() and create() 
   - Well-documented code with plain-english explanations of functions
 - Integration includes the following features
   - Authentication against NetForum
   - Just-In-Time Drupal User Provisioning
   - Syncronization of data regarding facilities, vendors, and events stored in NetForum's various CRM areas
   - Form to manually run the sync
   - Cron job to pull in data on a regular basis

##d7module
 - A custom module for syncronizing data between Partners Healthcare's Mentor system and Drupal
 - Provides a form for manually syncing various parts of the data
 - Massages data from a series of CSV files
