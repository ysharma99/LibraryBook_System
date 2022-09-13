# Librarybooks

**Overview**

We developed a application  for borrowing and returning library books for our assignment. We employed three virtual machines. One that served as a customer web server, one that functioned as an admin web server, and one that operated as a database server. The customer is able to select books to borrow from the library which can be either accepted or declined by the administrator (Usually just declined if there is no stock). 

**How to run the application**

•The repository to our project need to be cloned from the link below using the command in terminal
git clone https://github.com/ysharma99/librarybooks.git 

•Once cloned, navigate through the terminal into the directory of the repository. Once there, use the following command in the terminal to start the virtual machines.
vagrant up --provider virtualbox

•To access the websites through the customer host port, navigate in a web browser to:
http://192.168.2.11:8082/customer/cLogin.html

• From here, you are able to use the linked words and buttons to travel across all our pages.

•To access the websites through the admin host port, navigate to the following address in a web browser:
http://192.168.2.12:8080/customer/cLogin.html
