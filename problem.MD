## Situation
A payment gateway services allows private and business clients to `deposit` and `withdraw` funds to and from its accounts in multiple currencies. Clients may be charged a commission fee.

You have to create an application that handles operations provided in CSV format and calculates a commission fee based on defined rules.

## Commission fee calculation
- Commission fee is always calculated in the currency of the operation. For example, if you `withdraw` or `deposit` in US dollars then commission fee is also in US dollars.
- Commission fees are rounded up to currency's decimal places. For example, `0.023 EUR` should be rounded up to `0.03 EUR`.

### Deposit rule
All deposits are charged 0.03% of deposit amount.

### Withdraw rules
There are different calculation rules for `withdraw` of `private` and `business` clients.

**Private Clients**
- Commission fee - 0.3% from withdrawn amount.
- 1000.00 EUR for a week (from Monday to Sunday) is free of charge. Only for the first 3 withdraw operations per a week. 4th and the following operations are calculated by using the rule above (0.3%). If total free of charge amount is exceeded them commission is calculated only for the exceeded amount (i.e. up to 1000.00 EUR no commission fee is applied).

For the second rule you will need to convert operation amount if it's not in Euros.

**Business Clients**
- Commission fee - 0.5% from withdrawn amount.

## Input data
Operations are given in a CSV file. In each line of the file the following data is provided:
1. operation date in format `Y-m-d`
2. user's identificator, number
3. user's type, one of `private` or `business`
4. operation type, one of `deposit` or `withdraw`
5. operation amount (for example `2.12` or `3`)
6. operation currency, one of `EUR`, `USD`, `JPY`

## Expected result
Output of calculated commission fees for each operation.

In each output line only final calculated commission fee for a specific operation must be provided without currency.

# Example usage
```
➜  cat input.csv
2014-12-31,4,private,withdraw,1200.00,EUR
2015-01-01,4,private,withdraw,1000.00,EUR
2016-01-05,4,private,withdraw,1000.00,EUR
2016-01-05,1,private,deposit,200.00,EUR
2016-01-06,2,business,withdraw,300.00,EUR
2016-01-06,1,private,withdraw,30000,JPY
2016-01-07,1,private,withdraw,1000.00,EUR
2016-01-07,1,private,withdraw,100.00,USD
2016-01-10,1,private,withdraw,100.00,EUR
2016-01-10,2,business,deposit,10000.00,EUR
2016-01-10,3,private,withdraw,1000.00,EUR
2016-02-15,1,private,withdraw,300.00,EUR
2016-02-19,5,private,withdraw,3000000,JPY

➜  php script.php input.csv
0.60
3.00
0.00
0.06
1.50
0
0.70
0.30
0.30
3.00
0.00
0.00
8612
```
Note: the example output is calculated base on the following exchange rates: EUR:USD - 1:1.1497, EUR:JPY - 1:129.53.