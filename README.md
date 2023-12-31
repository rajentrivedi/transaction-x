# TransactionX - Laravel Transaction Package

**TransactionX** is a powerful Laravel package designed to simplify database transactions within your application. This package provides a seamless way to handle database transactions for specific routes, ensuring data integrity and consistency.

## Features

- **Automatic Transactions:** TransactionX automatically manages database transactions for routes where it is applied. It starts a transaction before the route is executed and commits or rolls back the transaction based on the route's outcome.

- **Conditional Execution:** The package executes transactions only for non-GET requests, minimizing the impact on read-only operations and optimizing the database interactions for data-altering requests.

- **Error Handling:** TransactionX intelligently handles exceptions and errors during the route execution. If an exception occurs or if there are errors reported by Laravel's error handling system, the middleware rolls back the transaction to maintain a consistent state.

## Getting Started

 **Installation:**

Install the TransactionX package using Composer.

   ```bash
   composer require rajentrivedi/transaction-x
```

**Setup:**

Apply the TransactionMiddleware to the route group where you want to enable automatic transactions.

```bash
Route::group(['middleware' => 'transaction-x'], function () {
    	// Your routes here
});
```
Or, you can apply the TransactionMiddleware to specific route.

```bash
Route::post('/example', function () {
    	DB::table('your_table')->insert(['column' => 'value']);
		DB::table('some_other_table')->insert(['column' => 'value']);
    	return response()->json(['success' => true]);
})->middleware('transaction-x');
```

## Before Applying TransactionX

```bash
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\UserProfile;

class UserController extends Controller
{
    public function updateProfile(Request $request, $userId)
    {
        try {
            DB::beginTransaction();

            // Update user profile logic
            $user = User::find($userId);
            $user->update($request->all());

            // Additional operations with other tables
            $profile = UserProfile::where('user_id', $userId)->first();
            $profile->update($request->get('profile_data'));

            // Another operation...

            DB::commit();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
```
In this example, there are operations involving two different tables (User and UserProfile). Manually handling transactions in this scenario can lead to increased complexity and a higher chance of errors.

## After Applying TransactionX

```bash
use App\Models\User;
use App\Models\UserProfile;
class UserController extends Controller
{

    public function updateProfile(Request $request, $userId)
    {
        // Update user profile logic
        $user = User::find($userId);
        $user->update($request->all());

        // Additional operations with other tables
        $profile = UserProfile::where('user_id', $userId)->first();
        $profile->update($request->get('profile_data'));

        // Another operation...

        return response()->json(['success' => true]);
    }
}

```

With TransactionX, the middleware takes care of the transaction handling, even when there are multiple database interactions within the same route. This leads to cleaner and more readable code, as the developer can focus on the logic of the route without the need to manage transactions explicitly. The middleware ensures that the transactions are handled consistently across different tables, promoting code cleanliness and maintainability.

## Enjoy Consistent Transactions

With TransactionX, focus on building your application logic, while the package ensures that your database transactions are handled consistently.

## Contribution

If you encounter issues or have suggestions for improvements, feel free to open an issue or submit a pull request on the GitHub repository.

## License

TransactionX is open-source software licensed under the MIT License.
