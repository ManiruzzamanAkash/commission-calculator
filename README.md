# Commission calculator
A simple commission calculator for transaction - `Withdraw`, `Deposit` using `PHP-8.x` - [Problem](/problem.MD)

---

## Requirements
 - PHP >= 8.0
## How to start

### Clone the repository

```sh
git clone https://github.com/ManiruzzamanAkash/commission-calculator.git
```

### Go to that folder
```sh
cd commission-calculator
```

### Install composer dependencies

```sh
composer install
```

### PHPUnit Test
I've added total `33 tests`, and `37 assertions` for testing codebase.
```sh
composer run phpunit
```

### Run PHP-CS
```sh
composer run test-cs
```

### Run both PHPUnit + PHP-CS

```sh
composer run test
```

![PHPUnit Test Demo](https://i.ibb.co/pXRNY78/phpunit-test.png "PHPUnit Test Demo")

### Run project
From terminal, you can run this command to get the result of `input.csv`'s datasets.

`input.csv` - I've stored some real data in this file for testing commission.

```sh
php script.php
input.csv
```

![Run Live](https://i.ibb.co/VYFnP9m/php-terminal-output.png "Run Live")

### Run with Custom Data

Create a file `sample.csv` at project root -

Put some data's there and save, eg:

```csv
2014-12-31,4,private,withdraw,1200.00,EUR
2015-01-01,4,private,withdraw,1000.00,EUR
2016-01-05,4,private,withdraw,1000.00,EUR
2016-01-05,1,private,deposit,200.00,EUR
```

Now test our script from terminal
```sh
php script
sample.csv
```