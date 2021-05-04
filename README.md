# Maven Repository
If you can't get dependencies from the Google repository even with a VPN, most likely your access has been blocked.  
Try downloading http://dl.google.com/dl/android/maven2/com/android/tools/build/gradle/4.0.1/gradle-4.0.1.pom manually with the same VPN running, if successful, Head over to the [Usage](#usage) section below.

## Requirements
+ XAMPP (Don't use PHP's built-in web server)
+ PHP 8

## Usage
1. [Download the project](https://github.com/hossein-zare/maven-repository/archive/refs/heads/main.zip), Extract files into a folder inside the htdocs folder of XAMPP.  
2. Run the server.
3. Open the `build.gradle` file.

    Note! We assume that `maven-repository` is the folder you extracted the files to.

    ```gradle
    buildscript {
        repositories {
            maven { url 'http://127.0.0.1/maven-repository/repository/' } // +

            google()
            jcenter()
        }

        ...
    }
    ```

    Scroll down in the same file.

    ```gradle
    allprojects {
        repositories {
            maven { url 'http://127.0.0.1/maven-repository/repository/' } // +

            google()
            mavenCentral()
        }
    }
    ```

3. Open the `gradle.properties` file and add the following code.
    ```properties
    ...

    systemProp.org.gradle.internal.http.connectionTimeout=500000
    systemProp.org.gradle.internal.http.socketTimeout=500000
    ```

4. Turn on your VPN.
5. Visit http://127.0.0.1/maven-repository/repository/com/android/tools/build/gradle/4.0.1/gradle-4.0.1.pom, Done!

## Add more servers
In the `index.php` file, you can add as many servers as you want.

```php
$servers = [
    "https://repo1.maven.org/maven2/" => false,
    "https://dl.google.com/dl/android/maven2/" => true // if true, the file will be stored in the local repository
];
```
