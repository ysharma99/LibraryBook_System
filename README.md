# Librarybooks

**Overview**

We developed a application  for borrowing and returning library books for our assignment. We employed three virtual machines—one that served as a customer web server, one that functioned as an admin web server, and one that operated as a database server. The customer is able to select to borrow books from the library which can be either accepted or declined by the administrator.  

**How to run the application**

•The repository to our project need to be cloned from the link below using the command in terminal
git clone https://github.com/ysharma99/librarybooks.git 

•Once cloned, navigate through the terminal into the directory of the repository. Once there, use the following command in the terminal to start the virtual machines.
vagrant up --provider virtualbox

•To access the customer website, enter the following into a command prompt:
vagrant ssh cwebserver

•Then navigate in a web browser to:
http://127.0.0.1:8082

•To access the admin website, enter the following into a command prompt:
vagrant ssh awebserver

•Then, navigate to the following address in a web browser:
http://127.0.0.1:8080/
