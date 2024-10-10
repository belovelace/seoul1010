package com.seoul.app.look;

import lombok.RequiredArgsConstructor;
import lombok.extern.apachecommons.CommonsLog;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;

@Controller
@RequiredArgsConstructor
public class StateController {

    // 맵 경로에 매핑되는 메서드
    @GetMapping("/state")
    public String map(){
        return "state"; // home 디렉토리 내의 home 뷰를 반환
    }
}

