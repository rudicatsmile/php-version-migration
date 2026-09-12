# Common Pitfalls When Using Rector on Legacy PHP

## 1. Jumping Too Far Too Fast

**Problem:** Enabling `UP_TO_PHP_84` on a pure PHP 5.6 codebase in one run.  
**Result:** Hundreds of changes that are hard to review and may introduce subtle bugs.  
**Solution:** Always progress level by level and commit after each stage.

## 2. Trusting switch → match Conversion Blindly

`match` uses strict comparison (`===`).  
Old `switch` used loose comparison (`==`).  
This can change behavior with numeric strings, null, etc.

**Action:** Manually review every `match` that Rector creates from a `switch`.

## 3. Type Declaration Rules on Untyped Legacy Code

Adding parameter/return types too early can cause TypeErrors at runtime if the real data does not match the inferred type.

**Recommendation:**  
- First make the code run cleanly on the target PHP version.  
- Only then start adding types (preferably guided by PHPStan).

## 4. Database and Security Code

Rector has limited or no safe automatic migration for `mysql_*`.  
Never let automated tools rewrite database access without careful human review.

## 5. Ignoring Dry-Run Output

Always read the diff. Look especially for:
- Changes inside authentication / permission checks
- Changes inside payment or financial calculations
- Changes inside complex business rules

## 6. Running Rector Without Tests

Even minimal smoke tests dramatically reduce risk.  
If the project has zero tests, write a few critical-path tests before large Rector runs.

## 7. Forgetting to Re-scan After Changes

After applying Rector:
1. Run PHPCompatibility again
2. Run PHPStan / Psalm
3. Execute the application under the target PHP version

## Golden Rule

**Small batches + dry-run + review + test + commit**  
is always safer than one big automated rewrite.
