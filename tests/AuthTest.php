<?

use App\classes\Auth;
use PHPUnit\Framework\TestCase;


class AuthTest extends TestCase
{
    private $auth;
    private $session = [];
    /**
     * @before
     */
    public function setAuth()
    {
        $pdo = new PDO("sqlite::memory:", null, null, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
        $pdo->query('CREATE TABLE users (id INTEGER, username TEXT, password TEXT, role TEXT)');
        for ($i = 1; $i <= 10; $i++) {
            $pdo->query("INSERT INTO users (id,username,password,role) VALUES ($i,'user$i','user$i','user') ");
        }
        for ($i = 11; $i <= 20; $i++) {
            $pdo->query("INSERT INTO users (id,username,password,role) VALUES ($i,'admin$i','admin$i','admin') ");
        }
        $this->auth = new Auth($pdo, "login", $this->session);
    }
    public function testLoginBadUserName()
    {
        $this->assertNull($this->auth->login('qqq', 'www'));
    }
    public function testLoginBadPassword()
    {
        $this->assertNull($this->auth->login('user1', 'www'));
    }


    public function testLoginGoodUserNamePassword()
    {
        $a = $this->auth->login('user1', 'user1');
        $this->assertEquals(1, $this->session['auth']);
    }
}
