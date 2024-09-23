## Installation

1. Install the package via composer:

    ```shell
    composer require turahe/ledger
    ```

2. Publish resources (migrations and config files):

    ```shell
    php artisan vendor:publish --provider="Turahe\\Ledger\\Providers\\LedgerServiceProvider"
    ```

3. Execute migrations via the following command:

    ```shell
    php artisan migrate
    ```

4. Done!
