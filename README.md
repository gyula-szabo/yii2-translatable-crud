# Yii2 Translatable CRUD
This extension gives you the ability to easily add CRUD (Create Read Update Delete) functionality into your Yii project with translations, which works out of the box with useful features and can be customized.

## Installation
The extension can be installed via Composer.

### Adding the repositories
Add these repositories in your composer.json file, like this:
```
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/H3Tech/yii2-crud"
    },
    {
        "type": "vcs",
        "url": "https://github.com/gyula-szabo/yii2-translatable-crud"
    }
],
```
### Adding dependencies
Add entries for the extension in the require section in your composer.json:
```
"h3tech/yii2-crud": "dev-rework",
"h3tech/yii2-translatable-crud": "dev-master"
```
After this, you can execute `composer update` in your project directory to install the extension.
