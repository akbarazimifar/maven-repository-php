# Maven Repository
## Requirements
+ XAMPP
+ PHP 8

## Usage
[Download the project](https://github.com/hossein-zare/maven-repository/archive/refs/heads/main.zip), Extract files into a folder inside the htdocs folder of XAMPP.  
Run the server, Open `build.gradle` file.

```groovy
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

```groovy
allprojects {
    repositories {
        mavenLocal()
        maven {
            url("$rootDir/...")
        }
        maven {
            url("$rootDir/...")
        }
        
        maven { url 'http://127.0.0.1/maven-repository/repository/' } // +

        google()
        mavenCentral()
        
        maven { url 'https://maven.google.com' }
        maven { url 'https://www.jitpack.io' }
    }
}
```

Now turn on your VPN, Done!