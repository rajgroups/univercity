use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_user', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('name');
            $table->string('email')->unique();
            $table->string('son_of');
            $table->string('door_no');
            $table->date('dob');
            $table->string('blood_group');
            $table->string('street');
            $table->string('qualification');
            $table->string('id_proof'); // File path for ID proof
            $table->string('payment_screenshot'); // File path for Payment Screenshot
            $table->timestamps(); // Created_at & Updated_at
        });

        // Renaming column after table creation (if needed)
        Schema::table('tbl_user', function (Blueprint $table) {
            $table->renameColumn('blood_group', 'blood');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverting column name and dropping the table if necessary
        Schema::table('tbl_user', function (Blueprint $table) {
            $table->renameColumn('blood', 'blood_group');
        });

        Schema::dropIfExists('tbl_user');
    }
};
