# Fix-coding-standards-in-core

See https://www.drupal.org/node/2571965

> This is alpha state code

To run this use ```php codesnif.php```

For the moment this script is run manually, once the patch is created you have to create a drupal issue and upload the patch.
The nid of the issues is tracked so we can automate it later.

> Don't start creating issues, otherwise we'll end up with duplicates.

## Next steps

- Run codesniffer using each sniff, the one without any problem can be whitelisted right away
- Fix upstream errors in the coder module
- Manually fix the remaining errors
