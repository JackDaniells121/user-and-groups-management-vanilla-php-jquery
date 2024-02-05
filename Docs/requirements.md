[Requirements PL]

Podjęliśmy się stworzenia systemu informatycznego, jedną z jego podstawowych funkcjonalności jest zarządzanie użytkownikami i grupami użytkowników i od niej zaczynamy implementację. Klient życzy sobie, żeby system był dostępny przez przeglądarkę (zgodne z Chrome oraz Firefox). System ma przechowywać dane w bazie danych SQL. W ramach realizowanej usługi klient otrzyma źródła, dlatego wszystkie nazwy i komentarze powinny być zawarte w języku angielskim.

Wymagania co do projektu:  
Back-end: PHP7.xx, bez używania dodatkowych frameworków.
Front-end: Mile widziane użycie jQuery.
Baza: mysql lub mariadb


Funkcjonalności:

1. Zarządzanie użytkownikami:

a. Lista użytkowników  
b. Dodawanie użytkownika  
c. Usuwanie użytkownika  
d. Edycja użytkownika

2. Zarządzanie grupami użytkowników:

a. Lista grup użytkowników  
b. Dodawanie grupy użytkowników  
c. Usuwanie grupy użytkowników  
d. Edycja grupy użytkowników

Wymagana struktura danych prezentowana w aplikacji:

1. Użytkownik:

a. Nazwa  
b. Hasło  
c. Imię  
d. Nazwisko  
e. Data urodzenia  
f. Lista grup użytkowników


2. Grupa użytkowników:

a. Nazwa  
b. Lista użytkowników

Aplikacja powinna umożliwiać edycję wszystkich powyższych własności, także list.

Zadanie  
Proszę przygotować prostą aplikację zgodną z powyższą specyfikacją. Najistotniejszy z punktu widzenia oceny Kandydatów jest dla nas sposób zaprojektowania i jakość kodu, wygląd jest mniej ważny, ale nie należy go całkiem ignorować.  